<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SocialLink;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    public function dashboard()
    {
        $events = Event::orderBy('event_date', 'desc')->take(10)->get();
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('is_active', true)
            ->where('event_date', '>', now())
            ->count();
        $socialLinks = SocialLink::count();
        $isGoogleConnected = $this->googleCalendarService->isAuthenticated();

        return view('admin.dashboard', compact(
            'events',
            'totalEvents',
            'upcomingEvents',
            'socialLinks',
            'isGoogleConnected'
        ));
    }
}
