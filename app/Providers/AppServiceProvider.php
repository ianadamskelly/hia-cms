<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Contracts\View\View as ViewContract;
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
        View::composer([
            'layouts.app',
            'partials.*',
            'errors.*',
            'pages.*',
            'forms.*',
            'posts.*',
            'events.*',
            'downloads.*',
            'programmes.*',
            'campuses.*',
            'staff.*',
        ], function (ViewContract $view): void {
            static $frontendViewData;

            if ($frontendViewData === null) {
                $frontendViewData = $this->getFrontendViewData();
            }

            $view->with($frontendViewData);
        });
    }

    /**
     * @return array<string, mixed>
     */
    protected function getFrontendViewData(): array
    {
        $menus = Menu::query()
            ->with(['items.children'])
                ->whereIn('location', [
                    'main_navigation',
                    'header_actions',
                    'footer_quick_links',
                    'footer_company',
                ])
                ->get()
                ->keyBy('location');

        $defaultSiteSettings = $this->defaultSiteSettings();
        $settings = array_replace(
            $defaultSiteSettings,
            Setting::query()
                ->whereIn('key', array_keys($defaultSiteSettings))
                ->pluck('value', 'key')
                ->all()
        );

        return [
            'mainNavigationMenu' => $menus->get('main_navigation'),
            'headerActionsMenu' => $menus->get('header_actions'),
            'footerQuickLinksMenu' => $menus->get('footer_quick_links'),
            'footerCompanyMenu' => $menus->get('footer_company'),
            'siteSettings' => $settings,
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function defaultSiteSettings(): array
    {
        return [
            'site_name' => 'Hilal International Academy',
            'site_tagline' => 'A modern learning community',
            'site_description' => 'A modern learning community committed to academic excellence, character development, and global mindedness.',
            'contact_email' => 'info@hia.edu.so',
            'phone_primary' => '+252 61 6997840',
            'phone_secondary' => '',
            'address' => 'Mogadishu, Somalia',
            'footer_text' => 'Hilal International Academy. All rights reserved.',
            'facebook_url' => '',
            'instagram_url' => '',
            'linkedin_url' => '',
            'youtube_url' => '',
            'header_cta_label' => 'Apply Now',
            'header_cta_url' => '/admissions',
        ];
    }
}
