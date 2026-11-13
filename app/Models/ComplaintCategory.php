<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComplaintCategory extends Model
{
    protected $fillable = [
        'code',
        'name_en',
        'name_ta',
        'description_en',
        'description_ta',
        'icon',
        'department_name_en',
        'department_name_ta',
        'sla_days',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sla_days' => 'integer',
    ];

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ta' && !empty($this->name_ta) ? $this->name_ta : $this->name_en;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ta' && !empty($this->description_ta) ? $this->description_ta : $this->description_en;
    }

    public function getDepartmentNameAttribute(): string
    {
        return app()->getLocale() === 'ta' && !empty($this->department_name_ta) ? $this->department_name_ta : $this->department_name_en;
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'category_id');
    }
}
