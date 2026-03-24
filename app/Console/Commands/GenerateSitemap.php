<?php

namespace App\Console\Commands;

use App\Models\Campus;
use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use App\Models\Programme;
use App\Models\Staff;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'site:generate-sitemap';

    protected $description = 'Generate the website sitemap';

    public function handle(): int
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/news'))
            ->add(Url::create('/events'))
            ->add(Url::create('/downloads'))
            ->add(Url::create('/programmes'))
            ->add(Url::create('/campuses'))
            ->add(Url::create('/staff'))
            ->add(Url::create('/contact'))
            ->add(Url::create('/admissions-inquiry'));

        Page::where('is_published', true)->get()->each(function ($page) use ($sitemap) {
            $sitemap->add(Url::create("/{$page->slug}"));
        });

        Post::where('is_published', true)->get()->each(function ($post) use ($sitemap) {
            $sitemap->add(Url::create("/news/{$post->slug}"));
        });

        Event::where('is_published', true)->get()->each(function ($event) use ($sitemap) {
            $sitemap->add(Url::create("/events/{$event->slug}"));
        });

        Programme::where('is_published', true)->get()->each(function ($programme) use ($sitemap) {
            $sitemap->add(Url::create("/programmes/{$programme->slug}"));
        });

        Campus::where('is_published', true)->get()->each(function ($campus) use ($sitemap) {
            $sitemap->add(Url::create("/campuses/{$campus->slug}"));
        });

        Staff::where('is_published', true)->get()->each(function ($staff) use ($sitemap) {
            $sitemap->add(Url::create("/staff/{$staff->slug}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');

        return self::SUCCESS;
    }
}
