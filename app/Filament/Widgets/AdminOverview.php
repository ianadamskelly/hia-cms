<?php

namespace App\Filament\Widgets;

use App\Models\AdmissionInquiry;
use App\Models\ContactSubmission;
use App\Models\Event;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Contact Submissions', ContactSubmission::where('status', 'new')->count())
                ->description('Messages needing review')
                ->color('danger'),

            Stat::make('New Admission Inquiries', AdmissionInquiry::where('status', 'new')->count())
                ->description('Admissions leads to follow up')
                ->color('warning'),

            Stat::make('Published News Posts', Post::where('is_published', true)->count())
                ->description('Visible on the website')
                ->color('success'),

            Stat::make('Upcoming Events', Event::where('is_published', true)->where('start_at', '>=', now())->count())
                ->description('Future scheduled events')
                ->color('info'),
        ];
    }
}
