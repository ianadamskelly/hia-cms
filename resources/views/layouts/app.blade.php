<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $siteSettings['site_name'] ?? 'HIA CMS')</title>

    <meta name="description"
        content="@yield('meta_description', $siteSettings['site_description'] ?? 'Hilal International Academy')">
    <meta name="robots" content="@yield('meta_robots', 'index,follow')">

    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title"
        content="@yield('og_title', View::yieldContent('title', $siteSettings['site_name'] ?? 'HIA CMS'))">
    <meta property="og:description"
        content="@yield('og_description', View::yieldContent('meta_description', $siteSettings['site_description'] ?? 'Hilal International Academy'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'Hilal International Academy' }}">

    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="@yield('og_title', View::yieldContent('title', $siteSettings['site_name'] ?? 'HIA CMS'))">
    <meta name="twitter:description"
        content="@yield('og_description', View::yieldContent('meta_description', $siteSettings['site_description'] ?? 'Hilal International Academy'))">

    @hasSection('og_image')
        <meta name="twitter:image" content="@yield('og_image')">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-white text-gray-900 min-h-screen flex flex-col">
    @include('partials.header')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>

</html>