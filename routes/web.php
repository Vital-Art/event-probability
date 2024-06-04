<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VoteController;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::resource('events', EventController::class)->middleware('auth');
Route::post('events/{event}/vote', [VoteController::class, 'store'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


