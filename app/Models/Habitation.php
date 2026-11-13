<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Habitation extends Model
{
    protected $fillable = [
        'village_panchayat_id',
        'code',
        'name_en',
        'name_ta',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ta' && !empty($this->name_ta) ? $this->name_ta : $this->name_en;
    }

    public function villagePanchayat(): BelongsTo
    {
        return $this->belongsTo(VillagePanchayat::class);
    }
}
