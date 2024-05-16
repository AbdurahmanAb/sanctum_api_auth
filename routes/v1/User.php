<?php

use App\Http\Controllers\UserController;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user',[UserController::class, 'index']);
Route::get('/user/{id}',[UserController::class, 'show']);
Route::get('user/search/{name}',[UserController::class, 'search']);
Route::post('/user', ['UserController@store']);
Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
return response()->json(["message"=>"Logged Out"],201);
});
