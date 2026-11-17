<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{
    /**
     * Get all system configuration settings.
     */
    public function index(): JsonResponse
    {
        $settings = SystemSetting::all();
        $keyValue = $settings->pluck('value', 'key');

        return response()->json([
            'success' => true,
            'data' => $keyValue,
            'records' => $settings,
        ]);
    }

    /**
     * Update system settings.
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->except(['_token', 'api_token']);

        foreach ($data as $key => $value) {
            if ($value !== null) {
                SystemSetting::set($key, (string)$value, 'system');
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'System settings updated successfully.',
            'data' => SystemSetting::all()->pluck('value', 'key'),
        ]);
    }
}
