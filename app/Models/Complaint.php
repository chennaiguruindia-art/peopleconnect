<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Complaint extends Model
{
    protected $fillable = [
        'complaint_id',
        'citizen_name',
        'citizen_mobile',
        'citizen_email',
        'citizen_address',
        'district_id',
        'revenue_division_id',
        'taluk_id',
        'revenue_village_id',
        'custom_village_name',
        'ward_number',
        'landmark',
        'live_latitude',
        'live_longitude',
        'live_address',
        'category_id',
        'subject',
        'description',
        'priority',
        'status',
        'referral_status',
        'assigned_to',
        'privacy_consent',
        'is_public',
        'resolution_remarks',
        'resolved_at',
        'closed_at',
    ];

    protected $casts = [
        'privacy_consent' => 'boolean',
        'is_public' => 'boolean',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function revenueDivision(): BelongsTo
    {
        return $this->belongsTo(RevenueDivision::class);
    }

    public function taluk(): BelongsTo
    {
        return $this->belongsTo(Taluk::class);
    }

    public function revenueVillage(): BelongsTo
    {
        return $this->belongsTo(RevenueVillage::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'category_id');
    }

    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ComplaintAttachment::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(ComplaintHistory::class)->orderBy('created_at', 'desc');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(ComplaintAssignment::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(DepartmentReferral::class)->orderBy('created_at', 'desc');
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(CitizenFeedback::class);
    }

    public function getMaskedMobileAttribute(): string
    {
        if (strlen($this->citizen_mobile) >= 10) {
            return substr($this->citizen_mobile, 0, 2) . '******' . substr($this->citizen_mobile, -2);
        }
        return '******';
    }

    public function getVillageNameAttribute(): string
    {
        if ($this->revenueVillage) {
            return $this->revenueVillage->name;
        }
        if ($this->custom_village_name) {
            return $this->custom_village_name;
        }
        return $this->ward_number ? 'Ward ' . $this->ward_number : '-';
    }

    public function getStatusLabelAttribute(): string
    {
        return trans('messages.status_' . $this->status);
    }

    public function getHasLiveLocationAttribute(): bool
    {
        return !is_null($this->live_latitude) && !is_null($this->live_longitude);
    }

    public function getGoogleMapsUrlAttribute(): ?string
    {
        if (!$this->has_live_location) {
            return null;
        }

        return "https://www.google.com/maps?q={$this->live_latitude},{$this->live_longitude}";
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'submitted' => 'bg-secondary text-white',
            'under_review' => 'bg-info text-dark',
            'awaiting_information' => 'bg-warning text-dark',
            'assigned' => 'bg-primary text-white',
            'referred' => 'bg-info text-white',
            'in_progress' => 'bg-primary text-white',
            'resolved' => 'bg-success text-white',
            'closed' => 'bg-dark text-white',
            'rejected' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }
}
