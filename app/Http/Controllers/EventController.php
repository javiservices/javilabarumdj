<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'asc')
            ->get();

        $isGoogleAuthenticated = $this->googleCalendarService->isAuthenticated();

        return view('events.index', compact('events', 'isGoogleAuthenticated'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'booking_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event = Event::create($validated);

        // Sync to Google Calendar if authenticated
        if ($this->googleCalendarService->isAuthenticated()) {
            $this->googleCalendarService->syncEventToGoogle($event);
        }

        return redirect()->route('events.index')
            ->with('success', 'Evento creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'booking_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        // Sync to Google Calendar if authenticated
        if ($this->googleCalendarService->isAuthenticated()) {
            $this->googleCalendarService->syncEventToGoogle($event);
        }

        return redirect()->route('events.index')
            ->with('success', 'Evento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete from Google Calendar if synced
        if ($event->google_event_id && $this->googleCalendarService->isAuthenticated()) {
            $this->googleCalendarService->deleteEventFromGoogle($event);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado correctamente');
    }

    /**
     * Display calendar view
     */
    public function calendar()
    {
        return view('events.calendar');
    }
}
