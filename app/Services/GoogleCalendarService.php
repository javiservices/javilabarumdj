<?php

namespace App\Services;

use App\Models\Event;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event as GoogleEvent;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    private $client;
    private $service;

    public function __construct()
    {
        // Check if credentials file exists
        $credentialsPath = storage_path('app/google-calendar/credentials.json');
        if (!file_exists($credentialsPath)) {
            // Google Calendar not configured, service will be disabled
            $this->client = null;
            $this->service = null;
            return;
        }

        try {
            $this->client = new Client();
            $this->client->setApplicationName(config('app.name'));
            $this->client->setScopes([Calendar::CALENDAR]);
            $this->client->setAuthConfig($credentialsPath);
            $this->client->setAccessType('offline');
            $this->client->setPrompt('select_account consent');

            // Load previously authorized token from storage
            $tokenPath = storage_path('app/google-calendar/token.json');
            if (file_exists($tokenPath)) {
                $accessToken = json_decode(file_get_contents($tokenPath), true);
                $this->client->setAccessToken($accessToken);
            }

            // Refresh the token if it's expired
            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    file_put_contents($tokenPath, json_encode($this->client->getAccessToken()));
                }
            }

            $this->service = new Calendar($this->client);
        } catch (\Exception $e) {
            Log::error('Error initializing Google Calendar Service: ' . $e->getMessage());
            $this->client = null;
            $this->service = null;
        }
    }

    /**
     * Get authorization URL for OAuth2
     */
    public function getAuthUrl()
    {
        if (!$this->client) {
            return null;
        }
        return $this->client->createAuthUrl();
    }

    /**
     * Exchange authorization code for access token
     */
    public function authenticate($code)
    {
        $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);
        $this->client->setAccessToken($accessToken);

        // Save the token to storage
        $tokenPath = storage_path('app/google-calendar/token.json');
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($accessToken));

        return $accessToken;
    }

    /**
     * Sync event to Google Calendar
     */
    public function syncEventToGoogle(Event $event)
    {
        if (!$this->service) {
            return false;
        }

        try {
            $googleEvent = new GoogleEvent([
                'summary' => $event->title,
                'location' => $event->location,
                'description' => $event->description,
                'start' => [
                    'dateTime' => $event->event_date->toRfc3339String(),
                    'timeZone' => config('app.timezone'),
                ],
                'end' => [
                    'dateTime' => $event->event_date->addHours(3)->toRfc3339String(),
                    'timeZone' => config('app.timezone'),
                ],
            ]);

            if ($event->google_event_id) {
                // Update existing event
                $googleEvent = $this->service->events->update(
                    'primary',
                    $event->google_event_id,
                    $googleEvent
                );
            } else {
                // Create new event
                $googleEvent = $this->service->events->insert('primary', $googleEvent);
                $event->google_event_id = $googleEvent->getId();
            }

            $event->synced_at = now();
            $event->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error syncing event to Google Calendar: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Import events from Google Calendar
     */
    public function importEventsFromGoogle()
    {
        if (!$this->service) {
            return 0;
        }

        try {
            $optParams = [
                'maxResults' => 50,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => now()->toRfc3339String(),
            ];

            $results = $this->service->events->listEvents('primary', $optParams);
            $events = $results->getItems();

            $imported = 0;
            foreach ($events as $googleEvent) {
                // Check if event already exists
                $existingEvent = Event::where('google_event_id', $googleEvent->getId())->first();

                if (!$existingEvent) {
                    Event::create([
                        'title' => $googleEvent->getSummary(),
                        'description' => $googleEvent->getDescription(),
                        'location' => $googleEvent->getLocation(),
                        'event_date' => $googleEvent->getStart()->getDateTime(),
                        'google_event_id' => $googleEvent->getId(),
                        'synced_at' => now(),
                        'is_active' => true,
                    ]);
                    $imported++;
                }
            }

            return $imported;
        } catch (\Exception $e) {
            Log::error('Error importing events from Google Calendar: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Delete event from Google Calendar
     */
    public function deleteEventFromGoogle(Event $event)
    {
        if (!$this->service) {
            return false;
        }

        try {
            if ($event->google_event_id) {
                $this->service->events->delete('primary', $event->google_event_id);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Error deleting event from Google Calendar: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if client is authenticated
     */
    public function isAuthenticated()
    {
        if (!$this->client) {
            return false;
        }

        $tokenPath = storage_path('app/google-calendar/token.json');
        return file_exists($tokenPath) && !$this->client->isAccessTokenExpired();
    }
}
