<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentReferral extends Model
{
    protected $fillable = [
        'complaint_id',
        'department_name',
        'officer_name',
        'officer_contact',
        'referral_letter_no',
        'referral_date',
        'acknowledgement_status',
        'remarks',
        'response_date',
        'resolution_details',
        'referred_by',
    ];

    protected $casts = [
        'referral_date' => 'date',
        'response_date' => 'date',
    ];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
}
