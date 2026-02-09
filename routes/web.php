<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    $upcomingEvents = \App\Models\Event::where('is_active', true)
        ->where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->take(3)
        ->get();
    return view('welcome', compact('upcomingEvents'));
});

// Public events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/calendar', [EventController::class, 'calendar'])->name('events.calendar');

// Public links page (Linktree style)
Route::get('/links', [SocialLinkController::class, 'links'])->name('links');

// Contact
Route::get('/contacto', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

// Admin routes (protected)
Route::middleware(['auth'])->group(function () {
    // Dashboard (redirect from /dashboard to /admin)
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Events management
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/admin/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/admin/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/admin/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    
    // Social links management
    Route::resource('social-links', SocialLinkController::class)->except(['show']);
    
    // Google Calendar integration
    Route::get('/google/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.auth');
    Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::post('/google/import', [GoogleCalendarController::class, 'importEvents'])->name('google.import');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
