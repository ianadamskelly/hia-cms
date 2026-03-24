<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'content',
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
        static::saving(function ($post) {
            if (blank($post->slug) && filled($post->title)) {
                $post->slug = Str::slug($post->title);
            }

            if ($post->is_published && blank($post->published_at)) {
                $post->published_at = now();
            }

            if (! $post->is_published) {
                $post->published_at = null;
            }
        });

        static::creating(function ($post) {
            if (blank($post->author_id) && auth()->check()) {
                $post->author_id = auth()->id();
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at');
    }
}
