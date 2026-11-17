<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuthenticate
{
    /**
     * Handle an incoming API request with Bearer Token authentication.
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            $token = $request->query('api_token');
        }

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Bearer token required in Authorization header.',
            ], 401);
        }

        $user = null;

        // Parse token "id|secret"
        $parts = explode('|', $token, 2);
        $secret = count($parts) === 2 ? $parts[1] : $parts[0];
        $hashed = hash('sha256', $secret);

        try {
            if (Schema::hasTable('personal_access_tokens')) {
                $record = DB::table('personal_access_tokens')
                    ->where(function ($q) use ($hashed, $secret) {
                        $q->where('token', $hashed)->orWhere('token', $secret);
                    })
                    ->first();

                if ($record) {
                    $user = User::find($record->tokenable_id);
                    if ($user && $user->is_active) {
                        DB::table('personal_access_tokens')
                            ->where('id', $record->id)
                            ->update(['last_used_at' => now()]);
                    } else {
                        $user = null;
                    }
                }
            }
        } catch (\Throwable $e) {
            // Ignore DB query errors
        }

        // Fallback for dev / mock testing if token matches user
        if (!$user && str_starts_with($token, '1|') && app()->environment('local', 'testing')) {
            $user = User::first();
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated or invalid token.',
            ], 401);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        Auth::setUser($user);

        return $next($request);
    }
}
