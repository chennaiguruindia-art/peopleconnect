<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    protected $fillable = [
        'code',
        'name_en',
        'name_ta',
        'state',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ta' && !empty($this->name_ta) ? $this->name_ta : $this->name_en;
    }

    public function revenueDivisions(): HasMany
    {
        return $this->hasMany(RevenueDivision::class);
    }

    public function taluks(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Taluk::class, RevenueDivision::class);
    }

    public function developmentBlocks(): HasMany
    {
        return $this->hasMany(DevelopmentBlock::class);
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }

    public function townPanchayats(): HasMany
    {
        return $this->hasMany(TownPanchayat::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
