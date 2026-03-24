<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Programme extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'short_name',
        'excerpt',
        'description',
        'age_range',
        'curriculum_type',
        'sort_order',
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
        static::saving(function ($programme) {
            if (blank($programme->slug) && filled($programme->name)) {
                $programme->slug = Str::slug($programme->name);
            }

            if ($programme->is_published && blank($programme->published_at)) {
                $programme->published_at = now();
            }

            if (! $programme->is_published) {
                $programme->published_at = null;
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }
}
