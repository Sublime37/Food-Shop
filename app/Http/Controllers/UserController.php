<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = new User($request->validated());
        $user->save();
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json(["token" => $token], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::firstWhere("email", $data["email"]);
        if (!$user || !Hash::check($data["password"], $user->password)) {
            return response()->json(["status" => "Неверно указана почта или пароль"], 401);
        }
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json(["token" => $token], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();
        return response()->json(["status" => "Текущая сессия закрыта"], 200);
    }
}
