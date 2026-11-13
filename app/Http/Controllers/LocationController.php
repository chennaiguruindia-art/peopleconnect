<?php

namespace App\Http\Controllers;

use App\Models\DevelopmentBlock;
use App\Models\District;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\Taluk;
use App\Models\VillagePanchayat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function districts(): JsonResponse
    {
        $districts = District::where('is_active', true)->orderBy('name_en')->get(['id', 'code', 'name_en', 'name_ta']);
        return response()->json(['success' => true, 'data' => $districts]);
    }

    public function divisions(Request $request): JsonResponse
    {
        $query = RevenueDivision::where('is_active', true);
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }
        $divisions = $query->orderBy('name_en')->get(['id', 'code', 'name_en', 'name_ta', 'district_id']);
        return response()->json(['success' => true, 'data' => $divisions]);
    }

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
        return response()->json(['success' => true, 'data' => $taluks]);
    }

    public function villages(Request $request): JsonResponse
    {
        $query = RevenueVillage::where('is_active', true);
        if ($request->filled('taluk_id')) {
            $query->where('taluk_id', $request->taluk_id);
        }
        $villages = $query->orderBy('firka')->orderBy('name_en')->get(['id', 'code', 'name_en', 'name_ta', 'firka', 'taluk_id']);
        return response()->json(['success' => true, 'data' => $villages]);
    }

    public function blocks(): JsonResponse
    {
        $blocks = DevelopmentBlock::where('is_active', true)->get(['id', 'code', 'name_en', 'name_ta']);
        return response()->json(['success' => true, 'data' => $blocks]);
    }

    public function panchayats(Request $request): JsonResponse
    {
        $query = VillagePanchayat::where('is_active', true);
        if ($request->filled('block_id')) {
            $query->where('development_block_id', $request->block_id);
        }
        $panchayats = $query->get(['id', 'code', 'name_en', 'name_ta', 'development_block_id']);
        return response()->json(['success' => true, 'data' => $panchayats]);
    }
}
