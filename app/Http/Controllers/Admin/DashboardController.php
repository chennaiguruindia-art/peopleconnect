<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Taluk;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total' => Complaint::count(),
            'submitted' => Complaint::where('status', 'submitted')->count(),
            'under_review' => Complaint::where('status', 'under_review')->count(),
            'pending' => Complaint::where('status', 'awaiting_information')->count(),
            'in_progress' => Complaint::whereIn('status', ['assigned', 'in_progress'])->count(),
            'referred' => Complaint::where('referral_status', '!=', 'not_referred')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'rejected' => Complaint::where('status', 'rejected')->count(),
        ];

        $recentComplaints = Complaint::with(['taluk', 'category', 'assignedStaff'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentComplaints'));
    }

    public function chartData(): JsonResponse
    {
        // 1. Monthly Complaints (Last 6 Months) from MySQL
        $monthlyLabels = [];
        $monthlyValues = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthKey = $monthDate->format('M Y');
            $count = Complaint::whereYear('created_at', $monthDate->year)
                ->whereMonth('created_at', $monthDate->month)
                ->count();

            $monthlyLabels[] = $monthKey;
            $monthlyValues[] = $count;
        }

        // 2. Category-wise Complaints from MySQL
        $categoryData = ComplaintCategory::withCount('complaints')
            ->where('is_active', true)
            ->get();

        $catLabels = [];
        $catValues = [];
        foreach ($categoryData as $cat) {
            $catLabels[] = $cat->name;
            $catValues[] = $cat->complaints_count;
        }

        // 3. Taluk-wise Complaints from MySQL
        $talukData = Taluk::withCount('complaints')
            ->where('is_active', true)
            ->get();

        $talukLabels = [];
        $talukValues = [];
        foreach ($talukData as $taluk) {
            $talukLabels[] = $taluk->name;
            $talukValues[] = $taluk->complaints_count;
        }

        // 4. Status Distribution from MySQL
        $statuses = [
            'submitted',
            'under_review',
            'awaiting_information',
            'assigned',
            'referred',
            'in_progress',
            'resolved',
            'closed',
            'rejected',
        ];

        $statusLabels = [];
        $statusValues = [];
        foreach ($statuses as $st) {
            $statusLabels[] = trans('messages.status_' . $st);
            $statusValues[] = Complaint::where('status', $st)->count();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'monthly' => ['labels' => $monthlyLabels, 'values' => $monthlyValues],
                'categories' => ['labels' => $catLabels, 'values' => $catValues],
                'taluks' => ['labels' => $talukLabels, 'values' => $talukValues],
                'statuses' => ['labels' => $statusLabels, 'values' => $statusValues],
            ],
        ]);
    }
}
