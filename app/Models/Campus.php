<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Campus extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'excerpt',
        'description',
        'email',
        'phone_primary',
        'phone_secondary',
        'address',
        'working_hours',
        'map_embed',
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
        static::saving(function ($campus) {
            if (blank($campus->slug) && filled($campus->name)) {
                $campus->slug = Str::slug($campus->name);
            }

            if ($campus->is_published && blank($campus->published_at)) {
                $campus->published_at = now();
            }

            if (! $campus->is_published) {
                $campus->published_at = null;
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->orderBy('sort_order');
    }
}
