<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;




Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('forgot-password', [AuthController::class, 'forgot']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    $routefilesPath = base_path('routes/v1/');
    $apiFiles = glob($routefilesPath . '/*.php');
    foreach ($apiFiles as $file) {
        require $file;
    }
});
