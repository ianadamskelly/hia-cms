<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteDefaultsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::setValue('site_name', 'Hilal International Academy');
        Setting::setValue('site_tagline', 'A modern learning community');
        Setting::setValue('contact_email', 'info@hia.edu.so');
        Setting::setValue('phone_primary', '+252 61 6997840');
        Setting::setValue('phone_secondary', '');
        Setting::setValue('address', 'Mogadishu, Somalia');
        Setting::setValue('footer_text', 'Hilal International Academy. All rights reserved.');

        $mainNavigation = Menu::firstOrCreate(
            ['location' => 'main_navigation'],
            ['name' => 'Main Navigation']
        );

        $headerActions = Menu::firstOrCreate(
            ['location' => 'header_actions'],
            ['name' => 'Header Actions']
        );

        $footerQuickLinks = Menu::firstOrCreate(
            ['location' => 'footer_quick_links'],
            ['name' => 'Footer Quick Links']
        );

        $footerCompany = Menu::firstOrCreate(
            ['location' => 'footer_company'],
            ['name' => 'Footer Company']
        );

        $mainNavigationItems = [
            ['label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'About', 'url' => '/pages/about-us', 'sort_order' => 2],
            ['label' => 'Programmes', 'url' => '/pages/programmes', 'sort_order' => 3],
            ['label' => 'Admissions', 'url' => '/pages/admissions', 'sort_order' => 4],
            ['label' => 'News', 'url' => '/news', 'sort_order' => 5],
            ['label' => 'Downloads', 'url' => '/downloads', 'sort_order' => 6],
            ['label' => 'Events', 'url' => '/events', 'sort_order' => 7],
            ['label' => 'Contact', 'url' => '/pages/contact', 'sort_order' => 8],
        ];

        foreach ($mainNavigationItems as $item) {
            MenuItem::firstOrCreate(
                [
                    'menu_id' => $mainNavigation->id,
                    'label' => $item['label'],
                ],
                [
                    'url' => $item['url'],
                    'target' => '_self',
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $headerActionItems = [
            ['label' => 'Log in', 'url' => '/admin/login', 'sort_order' => 1],
        ];

        foreach ($headerActionItems as $item) {
            MenuItem::firstOrCreate(
                [
                    'menu_id' => $headerActions->id,
                    'label' => $item['label'],
                ],
                [
                    'url' => $item['url'],
                    'target' => '_self',
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $footerQuickItems = [
            ['label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'About Us', 'url' => '/pages/about-us', 'sort_order' => 2],
            ['label' => 'Programmes', 'url' => '/pages/programmes', 'sort_order' => 3],
            ['label' => 'Admissions', 'url' => '/pages/admissions', 'sort_order' => 4],
            ['label' => 'News', 'url' => '/news', 'sort_order' => 5],
            ['label' => 'Events', 'url' => '/events', 'sort_order' => 6],
        ];

        foreach ($footerQuickItems as $item) {
            MenuItem::firstOrCreate(
                [
                    'menu_id' => $footerQuickLinks->id,
                    'label' => $item['label'],
                ],
                [
                    'url' => $item['url'],
                    'target' => '_self',
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $footerCompanyItems = [
            ['label' => 'About Us', 'url' => '/pages/about-us', 'sort_order' => 1],
            ['label' => 'Contact', 'url' => '/pages/contact', 'sort_order' => 2],
            ['label' => 'Downloads', 'url' => '/downloads', 'sort_order' => 3],
        ];

        foreach ($footerCompanyItems as $item) {
            MenuItem::firstOrCreate(
                [
                    'menu_id' => $footerCompany->id,
                    'label' => $item['label'],
                ],
                [
                    'url' => $item['url'],
                    'target' => '_self',
                    'sort_order' => $item['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        Setting::setValue('site_description', 'A modern learning community committed to academic excellence, character development, and global mindedness.');
        Setting::setValue('header_cta_label', 'Apply Now');
        Setting::setValue('header_cta_url', '/pages/admissions');
    }
}
