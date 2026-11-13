<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RevenueVillage extends Model
{
    protected $fillable = [
        'taluk_id',
        'firka',
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

    public function taluk(): BelongsTo
    {
        return $this->belongsTo(Taluk::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
