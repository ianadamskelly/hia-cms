<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'location',
        'type',
        'start_at',
        'end_at',
        'all_day',
        'is_featured',
        'is_published',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'all_day' => 'boolean',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function ($event) {
            if (blank($event->slug) && filled($event->title)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_at', '>=', now())
            ->orderBy('start_at');
    }
}
