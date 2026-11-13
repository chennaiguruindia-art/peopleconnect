<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ward extends Model
{
    protected $fillable = [
        'municipality_id',
        'town_panchayat_id',
        'ward_number',
        'name_en',
        'name_ta',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function townPanchayat(): BelongsTo
    {
        return $this->belongsTo(TownPanchayat::class);
    }
}
