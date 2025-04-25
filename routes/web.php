<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';



Route::middleware(['auth'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');