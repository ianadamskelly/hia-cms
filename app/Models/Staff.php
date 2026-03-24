<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Staff extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'slug',
        'title',
        'department',
        'excerpt',
        'bio',
        'email',
        'phone',
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
        static::saving(function ($staff) {
            if (blank($staff->slug) && filled($staff->name)) {
                $staff->slug = Str::slug($staff->name);
            }

            if ($staff->is_published && blank($staff->published_at)) {
                $staff->published_at = now();
            }

            if (! $staff->is_published) {
                $staff->published_at = null;
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->singleFile();
    }

    public function scopePublished($query)
    {
        return $query
            ->where('is_published', true)
            ->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order');
    }
}
