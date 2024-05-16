<?php


namespace App\Http\Controllers;

use App\Models\User;
use Exception;
Use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  User::all();
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|max:12|min:4'
        ]);

        try {
           $user =  User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
           ]);

           $token = $user->createToken('accessToken')->plainTextToken;
           return response(["user"=>$user, "token"=>$token],201);

        } catch (Exception $e) {
            return response()->json(["message" => $e], 500);
        }
    
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json(['message' => $user], 200);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $user->update(["name" => $request->name | $user->name, "email" => $request->email, "password" => $request->password]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(string $name)
    {
        return User::where('name','like', '%'.$name.'%')->get();
        //
    }
}
