<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menus = Menu::with(['items.children'])
                ->whereIn('location', [
                    'main_navigation',
                    'header_actions',
                    'footer_quick_links',
                    'footer_company',
                ])
                ->get()
                ->keyBy('location');

            $settings = [
                'site_name' => Setting::getValue('site_name', 'Hilal International Academy'),
                'site_tagline' => Setting::getValue('site_tagline', 'A modern learning community'),
                'site_description' => Setting::getValue('site_description', 'A modern learning community committed to academic excellence, character development, and global mindedness.'),
                'contact_email' => Setting::getValue('contact_email', 'info@hia.edu.so'),
                'phone_primary' => Setting::getValue('phone_primary', '+252 61 6997840'),
                'phone_secondary' => Setting::getValue('phone_secondary', ''),
                'address' => Setting::getValue('address', 'Mogadishu, Somalia'),
                'footer_text' => Setting::getValue('footer_text', 'Hilal International Academy. All rights reserved.'),
                'facebook_url' => Setting::getValue('facebook_url', ''),
                'instagram_url' => Setting::getValue('instagram_url', ''),
                'linkedin_url' => Setting::getValue('linkedin_url', ''),
                'youtube_url' => Setting::getValue('youtube_url', ''),
                'header_cta_label' => Setting::getValue('header_cta_label', 'Apply Now'),
                'header_cta_url' => Setting::getValue('header_cta_url', '/admissions'),
            ];

            $view->with([
                'mainNavigationMenu' => $menus->get('main_navigation'),
                'headerActionsMenu' => $menus->get('header_actions'),
                'footerQuickLinksMenu' => $menus->get('footer_quick_links'),
                'footerCompanyMenu' => $menus->get('footer_company'),
                'siteSettings' => $settings,
            ]);
        });
    }
}
