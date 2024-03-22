<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class LoginController
{
    public function __invoke(AuthLoginRequest $request): JsonResponse
    {
        dd(Http::get('http://localhost:5000/'));
        $request = $request->validated();

        $user = User::where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json(['message' => 'bad creds'], 403);
        } else {
            $token = $user->createToken('myAppToken')->plainTextToken;

            $response = [
                'token' => $token,
            ];

            return response()->json($response);
        }
    }
}
