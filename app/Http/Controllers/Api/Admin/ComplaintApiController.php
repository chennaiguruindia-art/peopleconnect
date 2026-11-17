<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintHistory;
use App\Models\DepartmentReferral;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplaintApiController extends Controller
{
    /**
     * List grievances with advanced filtering & search.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Complaint::with(['district', 'taluk', 'revenueVillage', 'category', 'assignedStaff', 'attachments'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $term = trim($request->search);
            $query->where(function ($q) use ($term) {
                $q->where('complaint_id', 'LIKE', "%{$term}%")
                  ->orWhere('citizen_name', 'LIKE', "%{$term}%")
                  ->orWhere('citizen_mobile', 'LIKE', "%{$term}%")
                  ->orWhere('subject', 'LIKE', "%{$term}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->filled('taluk_id')) {
            $query->where('taluk_id', $request->taluk_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $perPage = (int)$request->get('per_page', 15);
        $complaints = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $complaints->items(),
            'pagination' => [
                'current_page' => $complaints->currentPage(),
                'last_page' => $complaints->lastPage(),
                'per_page' => $complaints->perPage(),
                'total' => $complaints->total(),
            ],
        ]);
    }

    /**
     * Get complete details of a single grievance.
     */
    public function show(int $id): JsonResponse
    {
        $complaint = Complaint::with([
            'district',
            'revenueDivision',
            'taluk',
            'revenueVillage',
            'category',
            'assignedStaff',
            'attachments',
            'history.user',
            'referrals.referrer',
            'feedback',
        ])->find($id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance not found.',
            ], 404);
        }

        // Available staff list for assignment dropdown in app
        $availableStaff = User::where('is_active', true)
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['staff', 'admin', 'super_admin', 'nodal_officer']);
            })
            ->get(['id', 'name', 'email', 'mobile', 'designation', 'department']);

        return response()->json([
            'success' => true,
            'data' => $complaint,
            'available_officers' => $availableStaff,
        ]);
    }

    /**
     * Update grievance status with remarks and optional photo proof.
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance not found.',
            ], 404);
        }

        $isResolved = ($request->status === 'resolved');

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:submitted,under_review,awaiting_information,assigned,in_progress,resolved,rejected',
            'remarks' => 'required|string|max:1000',
            'resolution_photo' => $isResolved
                ? 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240'
                : 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();

            $prevStatus = $complaint->status;
            $newStatus = $request->status;

            $updateData = [
                'status' => $newStatus,
            ];

            if ($request->filled('assigned_to')) {
                $updateData['assigned_to'] = $request->assigned_to;
            }

            if ($newStatus === 'resolved') {
                $updateData['resolved_at'] = Carbon::now();
                $updateData['resolution_remarks'] = $request->remarks;
            }

            $complaint->update($updateData);

            // Save resolution attachment if provided
            if ($request->hasFile('resolution_photo')) {
                try {
                    $file = $request->file('resolution_photo');
                    $targetDir = public_path('storage/attachments/resolutions');
                    if (!is_dir($targetDir)) {
                        @mkdir($targetDir, 0777, true);
                    }

                    try {
                        $filePath = $file->store('attachments/resolutions', 'public');
                    } catch (\Throwable $fsEx) {
                        $fileName = \Illuminate\Support\Str::random(40) . '.' . $file->getClientOriginalExtension();
                        $file->move($targetDir, $fileName);
                        $filePath = 'attachments/resolutions/' . $fileName;
                    }

                    ComplaintAttachment::create([
                        'complaint_id' => $complaint->id,
                        'file_path' => $filePath,
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                        'attachment_type' => 'resolution_proof',
                        'uploaded_by' => $request->user()?->id,
                    ]);
                } catch (\Throwable $fileEx) {
                    \Illuminate\Support\Facades\Log::warning('Resolution photo upload notice: ' . $fileEx->getMessage());
                }
            }

            // Record audit history
            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => $request->user()?->id,
                'action' => 'Status Updated to ' . ucfirst(str_replace('_', ' ', $newStatus)),
                'previous_status' => $prevStatus,
                'new_status' => $newStatus,
                'remarks' => $request->remarks,
            ]);

            // Create notification for citizen
            Notification::create([
                'mobile' => $complaint->citizen_mobile,
                'title' => 'Grievance Update: ' . $complaint->complaint_id,
                'message' => "Dear citizen, your grievance {$complaint->complaint_id} status has been updated to: " . strtoupper($newStatus) . ". Remarks: {$request->remarks}",
                'type' => 'sms',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Grievance status updated successfully.',
                'data' => $complaint->fresh(['history', 'attachments', 'assignedStaff']),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Assign grievance to a designated officer.
     */
    public function assign(Request $request, int $id): JsonResponse
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'officer_id' => 'required|exists:users,id',
            'remarks' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $officer = User::find($request->officer_id);

        $complaint->update([
            'assigned_to' => $officer->id,
            'status' => ($complaint->status === 'submitted') ? 'assigned' : $complaint->status,
        ]);

        ComplaintHistory::create([
            'complaint_id' => $complaint->id,
            'user_id' => $request->user()?->id,
            'action' => "Assigned to {$officer->name}",
            'previous_status' => $complaint->status,
            'new_status' => $complaint->status,
            'remarks' => $request->remarks ?? "Assigned to {$officer->name} ({$officer->designation})",
        ]);

        return response()->json([
            'success' => true,
            'message' => "Grievance assigned to {$officer->name} successfully.",
            'data' => $complaint->fresh('assignedStaff'),
        ]);
    }

    /**
     * Refer grievance to an external government or civic department.
     */
    public function refer(Request $request, int $id): JsonResponse
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:150',
            'officer_name' => 'nullable|string|max:100',
            'officer_contact' => 'nullable|string|max:100',
            'referral_letter_no' => 'nullable|string|max:100',
            'remarks' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $referral = DepartmentReferral::create([
            'complaint_id' => $complaint->id,
            'department_name' => $request->department_name,
            'officer_name' => $request->officer_name,
            'officer_contact' => $request->officer_contact,
            'referral_letter_no' => $request->referral_letter_no,
            'referral_date' => Carbon::today(),
            'acknowledgement_status' => 'pending',
            'remarks' => $request->remarks,
            'referred_by' => $request->user()?->id,
        ]);

        $complaint->update([
            'referral_status' => 'referred_to_dept',
        ]);

        ComplaintHistory::create([
            'complaint_id' => $complaint->id,
            'user_id' => $request->user()?->id,
            'action' => "Referred to Department: {$request->department_name}",
            'previous_status' => $complaint->status,
            'new_status' => $complaint->status,
            'remarks' => $request->remarks,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Grievance referred to department successfully.',
            'data' => $referral,
        ]);
    }
}
