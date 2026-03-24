<?php

use App\Models\Menu;
use App\Models\Setting;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$menu = Menu::with('items')->where('location', 'header_actions')->first();
$settings = Setting::whereIn('key', ['header_cta_label', 'header_cta_url'])->get();

echo json_encode([
    'menu' => $menu,
    'settings' => $settings,
], JSON_PRETTY_PRINT);
