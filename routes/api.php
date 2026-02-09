<?php

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API endpoint for calendar events
Route::get('/events', function () {
    $events = Event::where('is_active', true)->get();
    
    return $events->map(function ($event) {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->event_date->toIso8601String(),
            'end' => $event->event_date->addHours(3)->toIso8601String(),
            'description' => $event->description,
            'location' => $event->location,
            'url' => route('events.show', $event),
        ];
    });
});
