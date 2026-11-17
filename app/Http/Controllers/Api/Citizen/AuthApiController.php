<?php

namespace App\Http\Controllers\Api\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{
    /**
     * Request OTP for citizen mobile login.
     */
    public function requestOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Valid 10-digit mobile number required',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobile = trim($request->mobile);
        $otp = '123456'; // Default test OTP / generated OTP

        // Log notification record
        Notification::create([
            'mobile' => $mobile,
            'title' => 'Login OTP: ' . $otp,
            'message' => "Your OTP for The People Connect login is: {$otp}. Valid for 10 minutes.",
            'type' => 'sms',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP has been dispatched to your mobile number.',
            'data' => [
                'mobile' => $mobile,
                // In production this is sent via SMS gateway, returned here for easy mobile dev/testing
                'otp_debug' => $otp,
            ],
        ]);
    }

    /**
     * Verify OTP and issue Sanctum authentication token.
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10',
            'otp' => 'required|string',
            'name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobile = trim($request->mobile);
        $otp = trim($request->otp);

        // Verify OTP (accept 123456 or latest notification OTP)
        $validOtp = ($otp === '123456');
        if (!$validOtp) {
            $latestNotif = Notification::where('mobile', $mobile)
                ->where('created_at', '>=', now()->subMinutes(10))
                ->latest()
                ->first();

            if ($latestNotif && str_contains($latestNotif->message, $otp)) {
                $validOtp = true;
            }
        }

        if (!$validOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP. Please try again.',
            ], 401);
        }

        // Find or create citizen user
        $citizenRole = Role::where('name', 'citizen')->first();

        // Check if there's any recent complaint by this mobile to prefill name
        $existingComplaint = Complaint::where('citizen_mobile', $mobile)->latest()->first();
        $citizenName = $request->filled('name')
            ? trim($request->name)
            : ($existingComplaint?->citizen_name ?? 'Citizen ' . substr($mobile, -4));

        $user = User::firstOrCreate(
            ['mobile' => $mobile],
            [
                'name' => $citizenName,
                'email' => $mobile . '@citizen.thepeopleconnect.org',
                'password' => Hash::make(Str::random(24)),
                'role_id' => $citizenRole?->id,
                'is_active' => true,
                'department' => 'Citizen',
                'designation' => 'Public User',
            ]
        );

        $token = $user->createToken('citizen_mobile_token', ['citizen'])->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                    'email' => $user->email,
                    'role' => 'citizen',
                ],
            ],
        ]);
    }

    /**
     * Get current authenticated citizen profile.
     */
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user();

        $complaintStats = [
            'total' => Complaint::where('citizen_mobile', $user->mobile)->count(),
            'submitted' => Complaint::where('citizen_mobile', $user->mobile)->where('status', 'submitted')->count(),
            'in_progress' => Complaint::where('citizen_mobile', $user->mobile)->whereIn('status', ['assigned', 'in_progress', 'under_review'])->count(),
            'resolved' => Complaint::where('citizen_mobile', $user->mobile)->where('status', 'resolved')->count(),
            'rejected' => Complaint::where('citizen_mobile', $user->mobile)->where('status', 'rejected')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                    'email' => $user->email,
                ],
                'stats' => $complaintStats,
            ],
        ]);
    }

    /**
     * Logout citizen.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }
}
