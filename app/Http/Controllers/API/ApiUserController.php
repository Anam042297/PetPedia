<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:20|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ]);

        // Create the user and generate a token
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'token' => $user->createToken('MyApp')->plainTextToken,
            'name' => $user->name,
            'email' => $user->email,
            'message' => 'User registration successful'
        ], 201);
    }



    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return response()->json([
                'token' => $user->createToken('MyApp')->plainTextToken,
                'name' => $user->name,
                'email' => $user->email,
                'message' => 'User login successful'
            ], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function getUserById($id)
    {
        // Find user by ID
        $user = User::findOrFail($id);

        // Return user information as JSON
        return response()->json([
            'user' => $user
        ], 200);
    }
}
