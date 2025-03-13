<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // auth api
  public function register(Request $request){

    $request->validate([
        'name'=> "required|max:255",
        "email"=> "email|required|unique:users",
        "password"=> "required|min:5",
        ]);
        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> bcrypt($request->password),
            ]);
            Auth::login($user);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([$user,$token], 201);

  }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "email|required|exists:users",
            "password" => "required",
        ]);
        $user = User::where("email", $request->email)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json(["error" => "Invalid credentials"], 401);
        }
        $token = $user->createToken("authToken")->plainTextToken;
        return response()->json(["user" => $user, "token" => $token], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(["message" => "Logged out successfully"]);
    }
    public function index()

    {
       $user= User::all();
        return response()->json($user);
    }
    // End of auth apii

}
