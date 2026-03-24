<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'template',
        'excerpt',
        'content',
        'is_published',
        'published_at',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function ($page) {
            if (blank($page->slug) && filled($page->title)) {
                $page->slug = Str::slug($page->title);
            }

            if ($page->is_published && blank($page->published_at)) {
                $page->published_at = now();
            }

            if (! $page->is_published) {
                $page->published_at = null;
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
    }
}
