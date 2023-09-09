<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('posts', PostController::class);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'eventList' => Event::all()
    ]);
})->name('home');


Route::post('/removeEvent', function (Request $request) {
    // Retrieve the event ID from the request
    $eventId = $request->input('id');

    // Call the removeEvent method from your controller
    return app(Event::class)->removeEvent($eventId);
})->name('removeEvent');

Route::post('/', function (Request $request) {
    // Retrieve the event ID from the request
    $eventId = $request->input('dateRange');

    // Call the removeEvent method from your controller
    return app(PostController::class)->filterEvent($eventId);
})->name('filterEvent');