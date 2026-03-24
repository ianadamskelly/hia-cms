<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Download extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'file_path',
        'original_name',
        'file_type',
        'file_size',
        'is_featured',
        'is_published',
        'published_at',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function ($download) {
            if (blank($download->slug) && filled($download->title)) {
                $download->slug = Str::slug($download->title);
            }

            if ($download->is_published && blank($download->published_at)) {
                $download->published_at = now();
            }

            if (! $download->is_published) {
                $download->published_at = null;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at');
    }
}
