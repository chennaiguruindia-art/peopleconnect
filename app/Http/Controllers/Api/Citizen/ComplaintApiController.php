<?php

namespace App\Http\Controllers\Api\Citizen;

use App\Http\Controllers\Controller;
use App\Models\CitizenFeedback;
use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use App\Models\ComplaintHistory;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplaintApiController extends Controller
{
    /**
     * Submit a new grievance / complaint.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'citizen_name' => 'required|string|max:100',
            'citizen_mobile' => 'required|digits:10',
            'citizen_email' => 'nullable|email|max:100',
            'citizen_address' => 'required|string|max:300',
            'district_id' => 'required|exists:districts,id',
            'revenue_division_id' => 'nullable|exists:revenue_divisions,id',
            'taluk_id' => 'required|exists:taluks,id',
            'revenue_village_id' => 'nullable',
            'custom_village_name' => 'nullable|string|max:150',
            'ward_number' => 'nullable|string|max:50',
            'landmark' => 'nullable|string|max:200',
            'live_latitude' => 'nullable|numeric|between:-90,90',
            'live_longitude' => 'nullable|numeric|between:-180,180',
            'live_address' => 'nullable|string|max:500',
            'category_id' => 'required|exists:complaint_categories,id',
            'subject' => 'required|string|max:200',
            'description' => 'required|string|max:2000',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:10240',
            'document' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
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

            // Auto-resolve revenue division if not explicitly provided
            $divisionId = $request->revenue_division_id;
            if (!$divisionId && $request->filled('taluk_id')) {
                $taluk = \App\Models\Taluk::find($request->taluk_id);
                $divisionId = $taluk?->revenue_division_id;
            }

            // Reverse-geocode server fallback if client sent lat/lng but could not resolve address
            if ($liveLat && $liveLng && empty($liveAddress)) {
                try {
                    $geoRes = \Illuminate\Support\Facades\Http::timeout(3)
                        ->withHeaders(['User-Agent' => 'ThePeopleConnectPortal/1.0'])
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
                    // Gracefully continue
                }
            }

            $complaint = Complaint::create([
                'complaint_id' => $complaintId,
                'citizen_name' => $request->citizen_name,
                'citizen_mobile' => $request->citizen_mobile,
                'citizen_email' => $request->citizen_email,
                'citizen_address' => $request->citizen_address,
                'district_id' => $request->district_id,
                'revenue_division_id' => $divisionId,
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
                try {
                    $photo = $request->file('photo');
                    $targetDir = public_path('storage/attachments/photos');
                    if (!is_dir($targetDir)) {
                        @mkdir($targetDir, 0777, true);
                    }

                    try {
                        $photoPath = $photo->store('attachments/photos', 'public');
                    } catch (\Throwable $fsEx) {
                        $fileName = \Illuminate\Support\Str::random(40) . '.' . $photo->getClientOriginalExtension();
                        $photo->move($targetDir, $fileName);
                        $photoPath = 'attachments/photos/' . $fileName;
                    }

                    ComplaintAttachment::create([
                        'complaint_id' => $complaint->id,
                        'file_path' => $photoPath,
                        'file_name' => $photo->getClientOriginalName(),
                        'file_type' => $photo->getClientMimeType(),
                        'file_size' => $photo->getSize(),
                        'attachment_type' => 'photo',
                    ]);
                } catch (\Throwable $fileEx) {
                    \Illuminate\Support\Facades\Log::warning('API photo upload notice: ' . $fileEx->getMessage());
                }
            }

            // Save Document Attachment
            if ($request->hasFile('document')) {
                try {
                    $doc = $request->file('document');
                    $targetDir = public_path('storage/attachments/documents');
                    if (!is_dir($targetDir)) {
                        @mkdir($targetDir, 0777, true);
                    }

                    try {
                        $docPath = $doc->store('attachments/documents', 'public');
                    } catch (\Throwable $fsEx) {
                        $fileName = \Illuminate\Support\Str::random(40) . '.' . $doc->getClientOriginalExtension();
                        $doc->move($targetDir, $fileName);
                        $docPath = 'attachments/documents/' . $fileName;
                    }

                    ComplaintAttachment::create([
                        'complaint_id' => $complaint->id,
                        'file_path' => $docPath,
                        'file_name' => $doc->getClientOriginalName(),
                        'file_type' => $doc->getClientMimeType(),
                        'file_size' => $doc->getSize(),
                        'attachment_type' => 'document',
                    ]);
                } catch (\Throwable $fileEx) {
                    \Illuminate\Support\Facades\Log::warning('API document upload notice: ' . $fileEx->getMessage());
                }
            }

            // Audit history
            ComplaintHistory::create([
                'complaint_id' => $complaint->id,
                'user_id' => null,
                'action' => 'Grievance Registered',
                'previous_status' => null,
                'new_status' => 'submitted',
                'remarks' => 'Grievance submitted by citizen with registered mobile ' . $complaint->masked_mobile,
            ]);

            // Notification log
            Notification::create([
                'mobile' => $complaint->citizen_mobile,
                'title' => 'Grievance Registered: ' . $complaint->complaint_id,
                'message' => 'Dear citizen, your grievance ' . $complaint->complaint_id . ' has been registered successfully on The People Connect platform.',
                'type' => 'sms',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Grievance registered successfully! / உங்கள் கோரிக்கை வெற்றிகரமாக பதிவு செய்யப்பட்டது.',
                'data' => [
                    'id' => $complaint->id,
                    'complaint_id' => $complaint->complaint_id,
                    'status' => $complaint->status,
                    'citizen_name' => $complaint->citizen_name,
                    'citizen_mobile' => $complaint->citizen_mobile,
                    'created_at' => $complaint->created_at->toISOString(),
                ],
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save grievance: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Track a grievance by complaint_id and citizen_mobile.
     */
    public function track(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'complaint_id' => 'required|string',
            'citizen_mobile' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $complaint = Complaint::with([
            'category',
            'district',
            'taluk',
            'revenueVillage',
            'assignedStaff',
            'attachments',
            'history' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'referrals',
            'feedback',
        ])
        ->where('complaint_id', trim($request->complaint_id))
        ->where('citizen_mobile', trim($request->citizen_mobile))
        ->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'No grievance found matching this Grievance ID and Mobile Number combination.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatComplaintPayload($complaint),
        ]);
    }

    /**
     * List all complaints filed by a citizen mobile number.
     */
    public function index(Request $request): JsonResponse
    {
        $mobile = $request->get('mobile', $request->user()?->mobile);

        if (empty($mobile)) {
            return response()->json([
                'success' => false,
                'message' => 'The mobile parameter is required to view your grievances.',
            ], 400);
        }

        $complaints = Complaint::with(['category', 'taluk', 'district', 'attachments'])
            ->where('citizen_mobile', trim($mobile))
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

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
     * Get single complaint detail by complaint_id (with optional mobile check).
     */
    public function show(Request $request, string $complaintId): JsonResponse
    {
        $query = Complaint::with([
            'category',
            'district',
            'taluk',
            'revenueVillage',
            'assignedStaff',
            'attachments',
            'history' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'referrals',
            'feedback',
        ]);

        if (is_numeric($complaintId)) {
            $query->where('id', (int)$complaintId);
        } else {
            $query->where('complaint_id', trim($complaintId));
        }

        if ($request->filled('mobile')) {
            $query->where('citizen_mobile', trim($request->mobile));
        }

        $complaint = $query->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatComplaintPayload($complaint),
        ]);
    }

    /**
     * Submit citizen feedback for a resolved complaint.
     */
    public function feedback(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'citizen_mobile' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'comments' => 'nullable|string|max:500',
            'is_satisfied' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $complaint = Complaint::where('id', $id)
            ->where('citizen_mobile', trim($request->citizen_mobile))
            ->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Grievance record not found for this mobile number.',
            ], 404);
        }

        $feedback = CitizenFeedback::updateOrCreate(
            ['complaint_id' => $complaint->id],
            [
                'rating' => $request->rating,
                'comments' => $request->comments,
                'is_satisfied' => $request->boolean('is_satisfied'),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your feedback has been recorded successfully.',
            'data' => $feedback,
        ]);
    }

    /**
     * Format complaint model for clean API response.
     */
    protected function formatComplaintPayload(Complaint $complaint): array
    {
        $historyData = $complaint->history->map(function ($h) {
            return [
                'action' => $h->action,
                'previous_status' => $h->previous_status,
                'new_status' => $h->new_status,
                'remarks' => $h->remarks,
                'created_at' => $h->created_at->toISOString(),
                'created_at_formatted' => $h->created_at->format('d M Y, h:i A'),
            ];
        });

        $attachmentsData = $complaint->attachments->map(function ($a) {
            return [
                'id' => $a->id,
                'file_name' => $a->file_name,
                'file_type' => $a->file_type,
                'file_size' => $a->file_size,
                'attachment_type' => $a->attachment_type,
                'url' => $a->url,
            ];
        });

        return [
            'id' => $complaint->id,
            'complaint_id' => $complaint->complaint_id,
            'citizen_name' => $complaint->citizen_name,
            'citizen_mobile' => $complaint->citizen_mobile,
            'masked_mobile' => $complaint->masked_mobile,
            'citizen_email' => $complaint->citizen_email,
            'citizen_address' => $complaint->citizen_address,
            'subject' => $complaint->subject,
            'description' => $complaint->description,
            'priority' => $complaint->priority,
            'status' => $complaint->status,
            'referral_status' => $complaint->referral_status,
            'category' => $complaint->category ? [
                'id' => $complaint->category->id,
                'name_en' => $complaint->category->name_en,
                'name_ta' => $complaint->category->name_ta,
                'department_name' => $complaint->category->department_name,
                'sla_days' => $complaint->category->sla_days,
            ] : null,
            'district' => $complaint->district ? [
                'id' => $complaint->district->id,
                'name_en' => $complaint->district->name_en,
                'name_ta' => $complaint->district->name_ta,
            ] : null,
            'taluk' => $complaint->taluk ? [
                'id' => $complaint->taluk->id,
                'name_en' => $complaint->taluk->name_en,
                'name_ta' => $complaint->taluk->name_ta,
            ] : null,
            'village_name' => $complaint->village_name,
            'ward_number' => $complaint->ward_number,
            'landmark' => $complaint->landmark,
            'live_latitude' => $complaint->live_latitude,
            'live_longitude' => $complaint->live_longitude,
            'live_address' => $complaint->live_address,
            'resolution_remarks' => $complaint->resolution_remarks,
            'resolved_at' => $complaint->resolved_at?->toISOString(),
            'created_at' => $complaint->created_at->toISOString(),
            'created_at_formatted' => $complaint->created_at->format('d M Y, h:i A'),
            'assigned_officer' => $complaint->assignedStaff ? [
                'id' => $complaint->assignedStaff->id,
                'name' => $complaint->assignedStaff->name,
                'designation' => $complaint->assignedStaff->designation ?? 'Nodal Officer',
                'department' => $complaint->assignedStaff->department ?? 'Grievance Cell',
            ] : null,
            'attachments' => $attachmentsData,
            'history' => $historyData,
            'feedback' => $complaint->feedback,
        ];
    }
}
