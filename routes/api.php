<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubWebhookController;
use App\Models\Build;
use Illuminate\Http\Request;
use App\Models\Build;

Route::middleware('auth:sanctum')->get('/builds', function (Request $request) {
    $query = Build::query();

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    if ($request->has('repository_id')) {
        $query->where('repository_id', $request->repository_id);
    }

    return $query->latest()->take(20)->get();
});
Route::middleware('auth:sanctum')->get('/builds', function () {
    return Build::latest()->take(10)->get();
});
Route::post('/github/webhook', [GitHubWebhookController::class, 'handle']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
