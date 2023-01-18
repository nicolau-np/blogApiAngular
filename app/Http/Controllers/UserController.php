<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('token_name');
            return response()->json(['data' => ['token' => $token->plainTextToken]], 200);
        }

        return response()->json(['data' => null], 401);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([], 204);
    }
}
