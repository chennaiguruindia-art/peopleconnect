<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitizenFeedback extends Model
{
    protected $table = 'citizen_feedback';

    protected $fillable = [
        'complaint_id',
        'rating',
        'comments',
        'is_satisfied',
    ];

    protected $casts = [
        'is_satisfied' => 'boolean',
        'rating' => 'integer',
    ];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }
}
