<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintCategory;
use App\Models\ComplaintHistory;
use App\Models\District;
use App\Models\Notification;
use App\Models\RevenueDivision;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    public function create(): View
    {
        $districts = District::where('is_active', true)->orderBy('name_en')->get();
        $categories = ComplaintCategory::where('is_active', true)->get();

        return view('public.submit-complaint', compact('districts', 'categories'));
    }

    public function store(StoreComplaintRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $districtId = $request->district_id;

            // Generate Unique Complaint ID: VNK-YYYYMMDD-XXXX
            $todayPrefix = 'VNK-' . date('Ymd') . '-';
            $lastComplaint = Complaint::where('complaint_id', 'LIKE', $todayPrefix . '%')
                ->orderBy('id', 'desc')
                ->lockForUpdate()
                ->first();

            $nextSequence = 1;
            if ($lastComplaint) {
                $lastNum = (int) substr($lastComplaint->complaint_id, -4);
                $nextSequence = $lastNum + 1;
            }
            $complaintId = $todayPrefix . str_pad($nextSequence, 4, '0', STR_PAD_LEFT);

            $villageId = is_numeric($request->revenue_village_id) ? (int)$request->revenue_village_id : null;
            $customVillage = $request->filled('custom_village_name') ? trim($request->custom_village_name) : null;
            $liveLat = $request->filled('live_latitude') ? (float)$request->live_latitude : null;
            $liveLng = $request->filled('live_longitude') ? (float)$request->live_longitude : null;
            $liveAddress = $request->filled('live_address') ? trim($request->live_address) : null;

            // Reverse-geocode server fallback if client sent lat/lng but could not resolve address
            if ($liveLat && $liveLng && empty($liveAddress)) {
                try {
                    $geoRes = \Illuminate\Support\Facades\Http::timeout(3)
                        ->withHeaders(['User-Agent' => 'VirudhunagarCivicPortal/1.0'])
                        ->get("https://nominatim.openstreetmap.org/reverse", [
                            'format' => 'json',
                            'lat' => $liveLat,
                            'lon' => $liveLng,
                            'zoom' => 18,
                            'addressdetails' => 1,
                        ]);
                    if ($geoRes->successful()) {
                        $liveAddress = $geoRes->json('display_name');
                    }
                } catch (\Throwable $e) {
                    // Gracefully ignore network timeout
                }
            }

            // Create Complaint
            $complaint = Complaint::create([
                'complaint_id' => $complaintId,
                'citizen_name' => $request->citizen_name,
                'citizen_mobile' => $request->citizen_mobile,
                'citizen_email' => $request->citizen_email,
                'citizen_address' => $request->citizen_address,
                'district_id' => $districtId,
                'revenue_division_id' => $request->revenue_division_id,
                'taluk_id' => $request->taluk_id,
                'revenue_village_id' => $villageId,
                'custom_village_name' => $customVillage,
                'ward_number' => $request->ward_number,
                'landmark' => $request->landmark,
                'live_latitude' => $liveLat,
                'live_longitude' => $liveLng,
                'live_address' => $liveAddress,
                'category_id' => $request->category_id,
                'subject' => $request->subject,
                'description' => $request->description,
                'priority' => $request->priority ?? 'medium',
                'status' => 'submitted',
                'referral_status' => 'not_referred',
                'privacy_consent' => true,
                'is_public' => true,
            ]);

            // Save Photo Attachment
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoPath = $photo->store('attachments/photos', 'public');

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $photoPath,
                    'file_name' => $photo->getClientOriginalName(),
                    'file_type' => $photo->getClientMimeType(),
                    'file_size' => $photo->getSize(),
                    'attachment_type' => 'photo',
                ]);
            }

            // Save Document Attachment
            if ($request->hasFile('document')) {
                $doc = $request->file('document');
                $docPath = $doc->store('attachments/documents', 'public');

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'file_path' => $docPath,
                    'file_name' => $doc->getClientOriginalName(),
                    'file_type' => $doc->getClientMimeType(),
                    'file_size' => $doc->getSize(),
                    'attachment_type' => 'document',
                ]);
            }

            // Initial Audit History
            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => null,
                'action' => 'Grievance Registered',
                'previous_status' => null,
                'new_status' => 'submitted',
                'remarks' => 'Grievance submitted by citizen with registered mobile ' . $complaint->masked_mobile,
            ]);

            // Create notification record
            Notification::create([
                'mobile' => $complaint->citizen_mobile,
                'title' => 'Grievance Registered: ' . $complaint->complaint_id,
                'message' => 'Dear citizen, your grievance ' . $complaint->complaint_id . ' has been registered successfully on குரலற்ற மகளின் குரல் portal.',
                'type' => 'sms',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Grievance registered successfully! / உங்கள் கோரிக்கை வெற்றிகரமாக பதிவு செய்யப்பட்டது.',
                'complaint_id' => $complaint->complaint_id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save grievance: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function trackView(Request $request): View
    {
        $complaintId = $request->get('complaint_id', '');
        $mobile = $request->get('mobile', '');

        return view('public.track-complaint', compact('complaintId', 'mobile'));
    }

    public function track(Request $request): JsonResponse
    {
        $request->validate([
            'complaint_id' => 'required|string',
            'citizen_mobile' => 'required|string',
        ]);

        $complaint = Complaint::with([
            'category',
            'taluk',
            'revenueVillage',
            'assignedStaff',
            'history' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'referrals',
        ])
        ->where('complaint_id', trim($request->complaint_id))
        ->where('citizen_mobile', trim($request->citizen_mobile))
        ->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'No grievance found matching this Grievance ID and Mobile Number combination (இணைப்பு காணப்படவில்லை).',
            ], 404);
        }

        // Prepare safe tracking payload
        $historyData = $complaint->history->map(function ($h) {
            return [
                'action' => $h->action,
                'previous_status' => $h->previous_status,
                'new_status' => $h->new_status,
                'new_status_label' => trans('messages.status_' . $h->new_status),
                'remarks' => $h->remarks,
                'created_at_formatted' => $h->created_at->format('d M Y, h:i A'),
            ];
        });

        $data = [
            'complaint_id' => $complaint->complaint_id,
            'subject' => $complaint->subject,
            'description' => $complaint->description,
            'category_name' => $complaint->category->name,
            'department_name' => $complaint->category->department_name,
            'district_name' => $complaint->district?->name ?? 'குரலற்ற மகளின் குரல்',
            'taluk_name' => $complaint->taluk?->name ?? 'Taluk',
            'village_name' => $complaint->village_name,
            'ward_number' => $complaint->ward_number,
            'status' => $complaint->status,
            'status_label' => $complaint->status_label,
            'status_badge_class' => $complaint->status_badge_class,
            'referral_status' => $complaint->referral_status,
            'referral_status_label' => trans('messages.referral_' . $complaint->referral_status),
            'resolution_remarks' => $complaint->resolution_remarks,
            'created_at_formatted' => $complaint->created_at->format('d M Y, h:i A'),
            'resolved_at_formatted' => $complaint->resolved_at ? $complaint->resolved_at->format('d M Y, h:i A') : null,
            'assigned_officer' => $complaint->assignedStaff ? [
                'name' => $complaint->assignedStaff->name,
                'designation' => $complaint->assignedStaff->designation ?? 'Nodal Officer',
                'department' => $complaint->assignedStaff->department ?? 'Grievance Cell',
            ] : null,
            'history' => $historyData,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
