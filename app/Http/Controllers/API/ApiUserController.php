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
        //dd(123); 
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        if ($validation->fails()) {
            $responce = [
                'error' => false,
                'message' => $validation->errors(),
            ];
            return response()->json($responce, 400);
        }
        $dataEntered = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => hash::make($request->password)
        ]);

        $success['token'] = $dataEntered->createToken('MyApp')->plainTextToken;
        $success['name'] = $dataEntered->name;
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User register successful'
        ];
        return response()->json($response, 200);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User login successful'
            ];
            return response()->json(['success' => true, 'data' => $success], 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Unauthorized'
            ];
            return response()->json($response, 200);
        }

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