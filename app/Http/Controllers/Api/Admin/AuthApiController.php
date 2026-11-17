<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    /**
     * Admin login with email and password.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::with('role')->where('email', trim($request->email))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is deactivated. Please contact portal super administrator.',
            ], 403);
        }

        if (!$user->isAdmin() && !$user->isStaff()) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied. Account is not authorized for administrative access.',
            ], 403);
        }

        // Generate Sanctum token
        $token = $user->createToken('admin_api_token', ['admin', 'staff'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Authentication successful',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'admin' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'designation' => $user->designation,
                    'department' => $user->department,
                    'role' => $user->role?->name ?? 'staff',
                    'is_super_admin' => ($user->role?->name === 'super_admin'),
                ],
            ],
        ]);
    }

    /**
     * Get current authenticated admin profile.
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user()->load('role');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'designation' => $user->designation,
                'department' => $user->department,
                'role' => $user->role?->name ?? 'staff',
                'is_super_admin' => ($user->role?->name === 'super_admin'),
            ],
        ]);
    }

    /**
     * Logout and revoke token.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
}
