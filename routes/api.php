<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Auth::routes();

// Route::post('/login', function(Request $request) {
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required'
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         return response()->json(["message" => "Invalid Credentials"], 401);
//     }
// return $user->createToken('login-token')->plainTextToken;
//     //return response()->json(["message" => "token created"], 204);
// });
// Route::post('/logout', function(Request $request) {
//     $request->user()->currentAccessToken()->delete();
//     return response()->json(["message" => "token deleted"], 204);
// });

// Route::post('/register', [Usercontroller::class, 'store']);

Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    $routefilesPath = base_path('routes/v1/');
     $apiFiles = glob($routefilesPath. '/*.php');
     foreach ($apiFiles as $file) {
        require $file;
    }

});

