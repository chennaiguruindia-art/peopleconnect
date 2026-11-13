<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\ComplaintHistory;
use App\Models\DepartmentReferral;
use App\Models\District;
use App\Models\Taluk;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ComplaintController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $query = Complaint::with(['district', 'taluk', 'revenueVillage', 'category', 'assignedStaff'])
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

        if ($request->filled('district_id')) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('taluk_id')) {
            $query->where('taluk_id', $request->taluk_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $complaints = $query->paginate(10)->withQueryString();

        if ($request->ajax() || $request->has('ajax')) {
            $html = view('admin.complaints.partials.table', compact('complaints'))->render();
            return response()->json(['success' => true, 'html' => $html]);
        }

        $districts = District::where('is_active', true)->orderBy('name_en')->get();
        $categories = ComplaintCategory::where('is_active', true)->get();
        $taluks = Taluk::where('is_active', true)->get();

        return view('admin.complaints.index', compact('complaints', 'districts', 'categories', 'taluks'));
    }

    public function show(int $id): View
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
        ])->findOrFail($id);

        $staffUsers = User::where('is_active', true)
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['staff', 'admin', 'super_admin', 'nodal_officer']);
            })
            ->get();

        return view('admin.complaints.show', compact('complaint', 'staffUsers'));
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $status = $request->status;
        $isResolved = ($status === 'resolved');

        $request->validate([
            'status' => 'required|in:submitted,assigned,in_progress,resolved',
            'remarks' => 'required|string|max:1000',
            'resolution_photo' => $isResolved
                ? 'required|file|mimes:jpeg,png,jpg,webp,pdf|max:10240'
                : 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ], [
            'status.in' => 'Please select a valid status (Received your complaint, Assigned officer to your complaint, Processing, or Completed).',
            'resolution_photo.required' => 'Proof attachment (photo or document) is required when marking status as Completed.',
            'resolution_photo.mimes' => 'Proof must be an image (JPEG, PNG, JPG, WEBP) or a PDF document.',
            'resolution_photo.max' => 'Proof file size must not exceed 10MB.',
        ]);

        $complaint = Complaint::findOrFail($id);
        $prevStatus = $complaint->status;
        $newStatus = $request->status;

        DB::beginTransaction();
        try {
            $updateData = ['status' => $newStatus];

            if ($newStatus === 'resolved') {
                $updateData['resolved_at'] = now();
                $updateData['resolution_remarks'] = $request->remarks;
            } elseif ($newStatus === 'closed') {
                $updateData['closed_at'] = now();
            }

            $complaint->update($updateData);

            // Handle evidence upload if present
            if ($request->hasFile('resolution_photo')) {
                $file = $request->file('resolution_photo');
                $path = $file->store('attachments/evidence', 'public');

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                    'attachment_type' => 'evidence_resolution',
                    'uploaded_by' => Auth::id(),
                ]);
            }

            // Always log into complaint_history
            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => Auth::id(),
                'action' => 'Status changed to ' . trans('messages.status_' . $newStatus),
                'previous_status' => $prevStatus,
                'new_status' => $newStatus,
                'remarks' => $request->remarks,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function assignStaff(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'instructions' => 'nullable|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($id);
        $assignedUser = User::findOrFail($request->assigned_to);

        DB::beginTransaction();
        try {
            $complaint->update([
                'assigned_to' => $assignedUser->id,
                'status' => in_array($complaint->status, ['submitted', 'under_review']) ? 'assigned' : $complaint->status,
            ]);

            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => Auth::id(),
                'action' => 'Assigned to ' . $assignedUser->name,
                'previous_status' => $complaint->status,
                'new_status' => $complaint->status,
                'remarks' => 'Assigned to ' . $assignedUser->name . ' (' . $assignedUser->designation . '). Instructions: ' . ($request->instructions ?? 'Field inspection and report required.'),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Complaint successfully assigned to ' . $assignedUser->name . '.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function referDepartment(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'department_name' => 'required|string|max:200',
            'officer_name' => 'nullable|string|max:150',
            'officer_contact' => 'nullable|string|max:50',
            'referral_letter_no' => 'nullable|string|max:100',
            'referral_date' => 'required|date',
            'remarks' => 'required|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($id);

        DB::beginTransaction();
        try {
            DepartmentReferral::create([
                'complaint_id' => $complaint->id,
                'department_name' => $request->department_name,
                'officer_name' => $request->officer_name,
                'officer_contact' => $request->officer_contact,
                'referral_letter_no' => $request->referral_letter_no ?? ('VNR/REF/' . date('Ymd') . '/' . rand(100, 999)),
                'referral_date' => $request->referral_date,
                'acknowledgement_status' => 'pending',
                'remarks' => $request->remarks,
                'referred_by' => Auth::id(),
            ]);

            // Update complaint referral status without marking resolved
            $complaint->update([
                'referral_status' => 'referred_to_department',
                'status' => 'referred',
            ]);

            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => Auth::id(),
                'action' => 'Referred to ' . $request->department_name,
                'previous_status' => $complaint->status,
                'new_status' => 'referred',
                'remarks' => 'Official referral to ' . $request->department_name . '. Letter No: ' . ($request->referral_letter_no ?? 'N/A') . '. Remarks: ' . $request->remarks,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Department referral recorded successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function exportExcel(Request $request): StreamedResponse
    {
        $fileName = 'virudhunagar_complaints_' . date('Ymd_His') . '.csv';

        $query = Complaint::with(['taluk', 'revenueVillage', 'category', 'assignedStaff'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('taluk_id')) {
            $query->where('taluk_id', $request->taluk_id);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $complaints = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($complaints) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM for Excel Tamil support

            fputcsv($handle, [
                'Grievance ID',
                'Citizen Name',
                'Mobile Number',
                'Taluk',
                'Village',
                'Category',
                'Subject',
                'Priority',
                'Status',
                'Referral Status',
                'Assigned Staff',
                'Submitted Date',
                'Resolved Date',
            ]);

            foreach ($complaints as $c) {
                fputcsv($handle, [
                    $c->complaint_id,
                    $c->citizen_name,
                    $c->citizen_mobile,
                    $c->taluk?->name_en ?? '',
                    $c->revenueVillage?->name_en ?? '',
                    $c->category->name_en,
                    $c->subject,
                    ucfirst($c->priority),
                    ucfirst(str_replace('_', ' ', $c->status)),
                    ucfirst(str_replace('_', ' ', $c->referral_status)),
                    $c->assignedStaff?->name ?? 'Unassigned',
                    $c->created_at->format('Y-m-d H:i:s'),
                    $c->resolved_at ? $c->resolved_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
