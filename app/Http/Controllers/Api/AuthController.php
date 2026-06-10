<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * POST /api/auth/register
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'password'     => Hash::make($request->input('password')),
            'is_new_user'  => true,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user'  => $user,
            'token' => $token,
        ], 'Registration successful.', 201);
    }

    /**
     * POST /api/auth/login
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return $this->errorResponse('Invalid credentials. Please check your email and password.', null, 401);
        }

        $user  = User::where('email', $request->input('email'))->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user'  => $user,
            'token' => $token,
        ], 'Login successful.');
    }

    /**
     * POST /api/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        
        /** @var \Laravel\Sanctum\PersonalAccessToken $token */
        $token = $user->currentAccessToken();
        $token->delete();

        return $this->successResponse(null, 'Logged out successfully.');
    }
    /**
     * GET /api/me
     */
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse($request->user(), 'User profile retrieved successfully.');
    }
}
