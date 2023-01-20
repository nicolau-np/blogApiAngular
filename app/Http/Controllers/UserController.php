<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(14);
        return UserResource::collection($users);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('token_name');
            return response()->json(['data' => ['token' => $token->plainTextToken, 'user' => $user]], 200);
        }

        return response()->json(['data' => null], 401);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'allDevice' => 'required|boolean'
        ]);

        $user = Auth::user();

        if ($request->allDevice) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return response(['message' => "Terminou sessao em todos os dispositivos"], 200);
        }
        $user->currentAccessToken()->delete();
        return response(['message' => "Terminou sessao em um dispositivo"], 200);

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nivel' => "user",
        ];
        $user = User::create($data);
        return new UserResource($user);
    }
}
