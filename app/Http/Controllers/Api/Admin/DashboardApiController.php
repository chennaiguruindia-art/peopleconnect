<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Taluk;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    /**
     * Get aggregate dashboard counters.
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total' => Complaint::count(),
            'submitted' => Complaint::where('status', 'submitted')->count(),
            'under_review' => Complaint::where('status', 'under_review')->count(),
            'awaiting_information' => Complaint::where('status', 'awaiting_information')->count(),
            'assigned' => Complaint::where('status', 'assigned')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'active_total' => Complaint::whereIn('status', ['submitted', 'under_review', 'assigned', 'in_progress'])->count(),
            'referred' => Complaint::where('referral_status', '!=', 'not_referred')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'rejected' => Complaint::where('status', 'rejected')->count(),
            'resolution_rate' => Complaint::count() > 0
                ? round((Complaint::where('status', 'resolved')->count() / Complaint::count()) * 100, 1)
                : 0,
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * Get analytical charts dataset for mobile dashboards.
     */
    public function charts(): JsonResponse
    {
        // 1. Monthly Trends (Last 6 Months)
        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthLabel = $monthDate->format('M Y');
            $count = Complaint::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();

            $resolvedCount = Complaint::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->where('status', 'resolved')
                ->count();

            $monthly[] = [
                'month' => $monthLabel,
                'total' => $count,
                'resolved' => $resolvedCount,
            ];
        }

        // 2. Category Distribution
        $categories = ComplaintCategory::withCount('complaints')
            ->where('is_active', true)
            ->get(['id', 'code', 'name_en', 'name_ta'])
            ->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name_en,
                    'name_ta' => $cat->name_ta,
                    'count' => $cat->complaints_count,
                ];
            });

        // 3. Taluk Distribution
        $taluks = Taluk::withCount('complaints')
            ->where('is_active', true)
            ->get(['id', 'code', 'name_en', 'name_ta'])
            ->map(function ($t) {
                return [
                    'id' => $t->id,
                    'name' => $t->name_en,
                    'name_ta' => $t->name_ta,
                    'count' => $t->complaints_count,
                ];
            });

        // 4. Status Breakdown
        $statuses = ['submitted', 'under_review', 'assigned', 'in_progress', 'resolved', 'rejected'];
        $statusBreakdown = [];
        foreach ($statuses as $st) {
            $statusBreakdown[$st] = Complaint::where('status', $st)->count();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'monthly_trends' => $monthly,
                'by_category' => $categories,
                'by_taluk' => $taluks,
                'by_status' => $statusBreakdown,
            ],
        ]);
    }
}
