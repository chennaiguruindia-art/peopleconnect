<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\PublicUpdate;
use App\Models\RevenueDivision;
use App\Models\RevenueVillage;
use App\Models\Taluk;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $activeDistrictIds = District::where('is_active', true)->pluck('id');
        $activeDivisionIds = RevenueDivision::whereIn('district_id', $activeDistrictIds)->pluck('id');
        $activeTaluksQuery = Taluk::whereIn('revenue_division_id', $activeDivisionIds)->where('is_active', true);
        $activeTalukIds = (clone $activeTaluksQuery)->pluck('id');

        $activeTalukCount = (clone $activeTaluksQuery)->count();
        $activeVillageCount = RevenueVillage::whereIn('taluk_id', $activeTalukIds)->count();

        $stats = [
            'total' => Complaint::count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'in_progress' => Complaint::whereIn('status', ['in_progress', 'assigned', 'under_review'])->count(),
            'referred' => Complaint::where('referral_status', '!=', 'not_referred')->count(),
            'taluks' => $activeTalukCount > 0 ? $activeTalukCount : Taluk::count(),
            'villages' => $activeVillageCount > 0 ? $activeVillageCount : RevenueVillage::count(),
        ];

        $categories = ComplaintCategory::where('is_active', true)->get();
        $updates = PublicUpdate::where('is_active', true)->orderBy('published_at', 'desc')->take(3)->get();
        $districts = District::where('is_active', true)->get();
        $taluks = (clone $activeTaluksQuery)->get();

        return view('public.home', compact('stats', 'categories', 'updates', 'districts', 'taluks'));
    }
}
