<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Taluk extends Model
{
    protected $fillable = [
        'revenue_division_id',
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

    public function revenueDivision(): BelongsTo
    {
        return $this->belongsTo(RevenueDivision::class);
    }

    public function revenueVillages(): HasMany
    {
        return $this->hasMany(RevenueVillage::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
