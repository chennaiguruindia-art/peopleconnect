<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Taluk;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $total = Complaint::count();
        $resolved = Complaint::where('status', 'resolved')->count();
        $inProgress = Complaint::whereIn('status', ['assigned', 'in_progress'])->count();
        $referred = Complaint::where('referral_status', '!=', 'not_referred')->count();
        $resolutionRate = $total > 0 ? round(($resolved / $total) * 100, 1) : 0;

        // Breakdown by Taluk
        $talukReports = Taluk::withCount([
            'complaints as total_count',
            'complaints as resolved_count' => function ($q) {
                $q->where('status', 'resolved');
            },
            'complaints as pending_count' => function ($q) {
                $q->whereIn('status', ['submitted', 'under_review', 'assigned', 'in_progress']);
            },
        ])->get();

        // Breakdown by Category
        $categoryReports = ComplaintCategory::withCount([
            'complaints as total_count',
            'complaints as resolved_count' => function ($q) {
                $q->where('status', 'resolved');
            },
        ])->get();

        return view('admin.reports.index', compact(
            'total',
            'resolved',
            'inProgress',
            'referred',
            'resolutionRate',
            'talukReports',
            'categoryReports'
        ));
    }
}
