<?php

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$user = User::first();
echo "User: {$user->email}\n";
echo 'Roles: '.json_encode($user->getRoleNames())."\n";
echo 'Permissions: '.json_encode($user->getAllPermissions()->pluck('name'))."\n";
