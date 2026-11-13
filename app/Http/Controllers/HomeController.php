<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\PublicUpdate;
use App\Models\RevenueVillage;
use App\Models\Taluk;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total' => Complaint::count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'in_progress' => Complaint::whereIn('status', ['in_progress', 'assigned', 'under_review'])->count(),
            'referred' => Complaint::where('referral_status', '!=', 'not_referred')->count(),
            'taluks' => Taluk::count(),
            'villages' => RevenueVillage::count(),
        ];

        $categories = ComplaintCategory::where('is_active', true)->get();
        $updates = PublicUpdate::where('is_active', true)->orderBy('published_at', 'desc')->take(3)->get();

        return view('public.home', compact('stats', 'categories', 'updates'));
    }
}
