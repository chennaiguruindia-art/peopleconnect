<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicUpdate extends Model
{
    protected $fillable = [
        'title_en',
        'title_ta',
        'content_en',
        'content_ta',
        'category',
        'source_name',
        'source_url',
        'featured_image',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getTitleAttribute(): string
    {
        $raw = app()->getLocale() === 'ta' && !empty($this->title_ta) ? $this->title_ta : $this->title_en;
        return \App\Services\VirudhunagarNewsService::sanitizeText($raw ?? '', (string)$this->source_name);
    }

    public function getContentAttribute(): string
    {
        $raw = app()->getLocale() === 'ta' && !empty($this->content_ta) ? $this->content_ta : $this->content_en;
        return \App\Services\VirudhunagarNewsService::sanitizeText($raw ?? '', (string)$this->source_name);
    }
}
