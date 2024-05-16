<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Invalid Credentials"], 401);
        }
        return $user->createToken('login-token')->plainTextToken;
        //return response()->json(["message" => "token created"], 204);
    }
    //

    function register(Request $request): Response
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|confirmed',
            'password' => 'required|max:12|min:4'
        ]);

        try {
            $user =  User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            $token = $user->createToken('accessToken')->plainTextToken;
            return response(["user" => $user, "token" => $token], 201);
        } catch (Exception $e) {
            return response()->json(["message" => $e], 500);
        }
    }

    function forgot(Request $request): Response
    {
        request()->validate(
            [
                'email' => 'required|email'
            ]
        );

        $user = User::whereEmail($request->email)->first();
        if(!$user){
return response(["Message"=>"Account Not Found"],404);
        }
        return response(["user"=>$user]);
    }
}
