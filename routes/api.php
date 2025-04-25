<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubWebhookController;
use App\Models\Build;

Route::middleware('auth:sanctum')->get('/builds', function () {
    return Build::latest()->take(10)->get();
});
Route::post('/github/webhook', [GitHubWebhookController::class, 'handle']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
