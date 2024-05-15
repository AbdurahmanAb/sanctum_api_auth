<?php

use App\Http\Controllers\UserController;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user',[UserController::class, 'index']);
Route::get('/user/{id}',[UserController::class, 'show']);
Route::post('/user', 'UserController@store');
