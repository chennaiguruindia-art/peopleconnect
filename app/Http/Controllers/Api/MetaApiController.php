<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\PublicUpdate;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\SystemSetting;
use App\Models\Taluk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetaApiController extends Controller
{
    /**
     * Get all active districts.
     */
    public function districts(): JsonResponse
    {
        $districts = District::where('is_active', true)
            ->orderBy('name_en')
            ->get(['id', 'code', 'name_en', 'name_ta']);

        return response()->json([
            'success' => true,
            'data' => $districts,
        ]);
    }

    /**
     * Get revenue divisions optionally filtered by district_id.
     */
    public function divisions(Request $request): JsonResponse
    {
        $query = RevenueDivision::where('is_active', true);

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        $divisions = $query->orderBy('name_en')->get(['id', 'code', 'name_en', 'name_ta', 'district_id']);

        return response()->json([
            'success' => true,
            'data' => $divisions,
        ]);
    }

    /**
     * Get taluks optionally filtered by division_id or district_id.
     */
    public function taluks(Request $request): JsonResponse
    {
        $query = Taluk::where('is_active', true);

        if ($request->filled('division_id')) {
            $query->where('revenue_division_id', $request->division_id);
        }

        if ($request->filled('district_id')) {
            $divisionIds = RevenueDivision::where('district_id', $request->district_id)->pluck('id');
            $query->whereIn('revenue_division_id', $divisionIds);
        }

        $taluks = $query->orderBy('name_en')->get(['id', 'code', 'name_en', 'name_ta', 'revenue_division_id']);

        return response()->json([
            'success' => true,
            'data' => $taluks,
        ]);
    }

    /**
     * Get revenue villages optionally filtered by taluk_id.
     */
    public function villages(Request $request): JsonResponse
    {
        $query = RevenueVillage::where('is_active', true);

        if ($request->filled('taluk_id')) {
            $query->where('taluk_id', $request->taluk_id);
        }

        $villages = $query->orderBy('firka')->orderBy('name_en')
            ->get(['id', 'code', 'name_en', 'name_ta', 'firka', 'taluk_id']);

        return response()->json([
            'success' => true,
            'data' => $villages,
        ]);
    }

    /**
     * Get all active complaint categories with department and SLA days.
     */
    public function categories(): JsonResponse
    {
        $categories = ComplaintCategory::where('is_active', true)
            ->orderBy('name_en')
            ->get(['id', 'code', 'name_en', 'name_ta', 'department_name_en', 'department_name_ta', 'sla_days', 'icon']);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Get public system contact information and platform metadata.
     */
    public function settings(): JsonResponse
    {
        $settings = [
            'portal_name' => config('app.name', 'The People Connect'),
            'slogan_en' => 'Voice of the Voiceless',
            'slogan_ta' => 'குரலற்ற மக்களின் குரல்',
            'contact_email' => SystemSetting::get('contact_email', 'thepeopleconnectofficial@gmail.com'),
            'contact_phone' => SystemSetting::get('contact_phone', '+91 9384995222'),
            'office_address' => SystemSetting::get('office_address', 'Civic Grievance Facilitation Center, Tirunelveli - 627001'),
            'instagram_handle' => '@thepeopleconnectofficial',
            'instagram_url' => 'https://www.instagram.com/thepeopleconnectofficial',
            'operating_hours' => 'Mon - Sat (9:00 AM - 6:00 PM)',
        ];

        return response()->json([
            'success' => true,
            'data' => $settings,
        ]);
    }

    /**
     * Get district emergency numbers directory.
     */
    public function emergencyDirectory(): JsonResponse
    {
        $directory = [
            [
                'service' => 'Police Control Room',
                'numbers' => ['100', '0462-2565500'],
                'primary_call' => '100',
                'category' => 'Police',
            ],
            [
                'service' => 'Fire & Rescue Services',
                'numbers' => ['101', '0462-2572101'],
                'primary_call' => '101',
                'category' => 'Fire',
            ],
            [
                'service' => 'Ambulance Service',
                'numbers' => ['108', '102'],
                'primary_call' => '108',
                'category' => 'Health',
            ],
            [
                'service' => 'TANGEDCO Electricity Fuse',
                'numbers' => ['1912'],
                'primary_call' => '1912',
                'category' => 'Electricity',
            ],
            [
                'service' => 'Women Helpline',
                'numbers' => ['1091', '181'],
                'primary_call' => '1091',
                'category' => 'Helpline',
            ],
            [
                'service' => 'Child Helpline',
                'numbers' => ['1098'],
                'primary_call' => '1098',
                'category' => 'Helpline',
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $directory,
        ]);
    }

    /**
     * Get public updates / announcements.
     */
    public function announcements(Request $request): JsonResponse
    {
        $updates = PublicUpdate::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->take($request->get('limit', 10))
            ->get();

        return response()->json([
            'success' => true,
            'data' => $updates,
        ]);
    }
}
