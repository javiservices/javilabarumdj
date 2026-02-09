<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class GoogleCalendarController extends Controller
{
    private $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        $authUrl = $this->googleCalendarService->getAuthUrl();
        
        if (!$authUrl) {
            return redirect()->route('events.index')
                ->with('error', 'Google Calendar no está configurado. Por favor, configura las credenciales primero.');
        }
        
        return redirect($authUrl);
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');

        if ($code) {
            $this->googleCalendarService->authenticate($code);
            return redirect()->route('events.index')
                ->with('success', 'Autenticación con Google Calendar exitosa');
        }

        return redirect()->route('events.index')
            ->with('error', 'Error en la autenticación con Google Calendar');
    }

    /**
     * Import events from Google Calendar
     */
    public function importEvents()
    {
        $imported = $this->googleCalendarService->importEventsFromGoogle();

        return redirect()->route('events.index')
            ->with('success', "Se importaron {$imported} eventos desde Google Calendar");
    }
}
