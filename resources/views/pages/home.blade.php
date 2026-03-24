@extends('layouts.app')

@section('title', 'Pioneer of Innovative Learning | ' . ($siteSettings['site_name'] ?? 'Hilal International Academy'))
@section('meta_description', 'Hilal International Academy is an Authorized IB World School in Mogadishu, offering PYP, MYP, and Diploma Programmes with a focus on excellence and global mindedness.')

@section('content')
    <!-- Immersive Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_campus.png') }}" alt="HIA Campus" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 py-32 w-full">
            <div class="max-w-3xl animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Authorized IB World School
                </div>
                
                <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight text-balance">
                    The Pioneer of <span class="text-blue-400">Innovative Learning</span> in the Horn of Africa.
                </h1>

                <p class="mt-8 text-xl text-slate-300 leading-relaxed max-w-2xl text-balance">
                    We are an authorized school for the <strong>Primary Years (PYP)</strong>, <strong>Middle Years (MYP)</strong>, and <strong>Diploma (DP)</strong> programmes, dedicated to nurturing excellence and character development.
                </p>

                <div class="mt-12 flex flex-wrap gap-5">
                    <a href="{{ $siteSettings['header_cta_url'] ?? '/pages/admissions' }}"
                        class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition-all hover:scale-105 shadow-lg shadow-blue-900/20">
                        {{ $siteSettings['header_cta_label'] ?? 'Apply Now' }}
                    </a>

                    <a href="{{ route('pages.show', 'about-us') }}"
                        class="glass-blur text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition-all border border-white/20">
                        Our Vision
                    </a>
                </div>
            </div>

            <!-- Floating Hero Cards (Asymmetric) -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in-up [animation-delay:200ms]">
                <div class="glass-dark p-8 rounded-3xl border-white/5 hover:border-blue-500/30 transition-colors group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/20 flex items-center justify-center mb-6 text-blue-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-3">Holistic Growth</h3>
                    <p class="text-slate-400 text-sm leading-6">Going beyond academics to foster social, emotional, and personal development in every child.</p>
                </div>
                <div class="glass-dark p-8 rounded-3xl border-white/5 hover:border-blue-500/30 transition-colors group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 flex items-center justify-center mb-6 text-indigo-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-3">Global Mindedness</h3>
                    <p class="text-slate-400 text-sm leading-6">Preparing students to thrive in a globalized world while respecting local values and traditions.</p>
                </div>
                <div class="glass-dark p-8 rounded-3xl border-white/5 hover:border-blue-500/30 transition-colors group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 flex items-center justify-center mb-6 text-emerald-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-3">Future Ready</h3>
                    <p class="text-slate-400 text-sm leading-6">Equipping learners with 21st-century skills to adapt and excel in an ever-changing environment.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <div class="relative bg-white border-b overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
                <div class="text-center md:text-left border-r last:border-0 border-slate-100 pr-4">
                    <p class="text-4xl font-bold text-slate-900 mb-2">2</p>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Districts<br><span class="text-[10px] lowercase">(Heliwaa & Banadir)</span></p>
                </div>
                <div class="text-center md:text-left border-r last:border-0 border-slate-100 pr-4">
                    <p class="text-4xl font-bold text-slate-900 mb-2">IB</p>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Authorized<br>World School</p>
                </div>
                <div class="text-center md:text-left border-r last:border-0 border-slate-100 pr-4">
                    <p class="text-4xl font-bold text-slate-900 mb-2">10</p>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Core<br>Institutional Values</p>
                </div>
                <div class="text-center md:text-left border-r last:border-0 border-slate-100 pr-4">
                    <p class="text-4xl font-bold text-slate-900 mb-2">DP/MYP</p>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-wider">Full Learning<br>Pathways</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Programmes Section -->
    <section class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div class="max-w-2xl">
                <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Our IB Programmes & Dugsiga</h2>
                <p class="mt-4 text-lg text-slate-600">
                    We offer a comprehensive learning journey from early years to university preparation, integrated with the study of the Holy Quran.
                </p>
            </div>

            <a href="{{ route('programmes.index') }}" class="inline-flex items-center text-blue-600 font-bold hover:gap-2 transition-all">
                Explore all programmes
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProgrammes as $programme)
                @php $image = $programme->getFirstMediaUrl('featured_image'); @endphp

                <article class="group relative bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[4/5] overflow-hidden relative">
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $programme->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                           <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                               <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                           </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>

                    <div class="p-8">
                        @if($programme->age_range)
                            <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">{{ $programme->age_range }}</p>
                        @endif
                        <h3 class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('programmes.show', $programme->slug) }}">
                                {{ $programme->name }}
                            </a>
                        </h3>
                        <p class="mt-4 text-slate-600 text-sm leading-relaxed line-clamp-2">
                            {{ $programme->excerpt ?? 'Our ' . $programme->name . ' is designed to nurture inquisitive minds and global citizens.' }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-4 py-20 text-center border-2 border-dashed border-slate-100 rounded-3xl text-slate-400">
                    Featured programmes are coming soon.
                </div>
            @endforelse
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="bg-slate-50 py-24 border-y">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Our Core Institutional Values</h2>
                <p class="mt-4 text-slate-600 text-lg">
                    These pillars define our culture, excellence, and the standard we set for our students and community.
                </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6">
                @php
                    $values = [
                        ['icon' => 'academic-cap', 'name' => 'Professionalism', 'color' => 'blue'],
                        ['icon' => 'shield-check', 'name' => 'Integrity', 'color' => 'indigo'],
                        ['icon' => 'globe-alt', 'name' => 'Diversity', 'color' => 'emerald'],
                        ['icon' => 'user-group', 'name' => 'Collaboration', 'color' => 'amber'],
                        ['icon' => 'heart', 'name' => 'Ethical Value System', 'color' => 'pink'],
                        ['icon' => 'chat-bubble-bottom-center-text', 'name' => 'Accountability', 'color' => 'slate'],
                        ['icon' => 'light-bulb', 'name' => 'Innovation', 'color' => 'cyan'],
                        ['icon' => 'sparkles', 'name' => 'Excellence', 'color' => 'yellow'],
                        ['icon' => 'users', 'name' => 'Caring & Inclusive', 'color' => 'rose'],
                        ['icon' => 'home-modern', 'name' => 'Community-Minded', 'color' => 'violet'],
                    ];
                @endphp

                @foreach($values as $value)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center text-center hover:shadow-md transition-shadow group">
                        <div class="w-10 h-10 rounded-xl bg-{{ $value['color'] }}-50 flex items-center justify-center text-{{ $value['color'] }}-600 mb-4 group-hover:scale-110 transition-transform">
                            <!-- Standard Lucide-like SVG icons based on name -->
                            <div class="w-5 h-5">
                                @if($value['name'] == 'Innovation')
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                @elseif($value['name'] == 'Integrity')
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                @else
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                @endif
                            </div>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm tracking-tight">{{ $value['name'] }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- News & Community Updates -->
    <section class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div class="max-w-2xl text-balance">
                <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Keep Updated with HIA</h2>
                <p class="mt-4 text-lg text-slate-600">
                    Latest highlights, typographic and lettering learning updates, and explorations from our vibrant community.
                </p>
            </div>

            <a href="{{ route('posts.index') }}" class="inline-flex items-center text-blue-600 font-bold hover:gap-2 transition-all">
                Read all news
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @forelse($latestPosts as $post)
                @php $featuredImage = $post->getFirstMediaUrl('featured_image'); @endphp

                <article class="flex flex-col group">
                    <div class="aspect-video rounded-3xl overflow-hidden mb-6 relative">
                        @if($featuredImage)
                            <img src="{{ $featuredImage }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            @if($post->category)
                                <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider">{{ $post->category->name }}</span>
                            @endif
                            <span class="text-slate-400 text-xs font-medium">{{ optional($post->published_at)->format('M j, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 leading-tight mb-4 group-hover:text-blue-600 md:h-14 overflow-hidden">
                            <a href="{{ route('posts.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="md:col-span-3 py-16 text-center text-slate-400">
                    No news updates available.
                </div>
            @endforelse
        </div>
    </section>

    <!-- Final Journey CTA -->
    <section class="max-w-7xl mx-auto px-4 pb-24">
        <div class="bg-blue-700 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden">
            <div class="absolute inset-0 z-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-400/20 via-transparent to-transparent"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-bold text-white tracking-tight text-balance">Begin Your Journey at the Pioneer of Innovative Learning.</h2>
                <p class="mt-8 text-blue-100 text-lg md:text-xl">
                    Whether you are starting with Dugsiga or moving through the IB Diploma Programme, we are ready to welcome you to our community.
                </p>
                <div class="mt-12 flex flex-wrap justify-center gap-5">
                    <a href="{{ $siteSettings['header_cta_url'] ?? '/pages/admissions' }}"
                        class="bg-white text-blue-700 px-10 py-5 rounded-2xl font-bold hover:bg-blue-50 transition-all hover:scale-105">
                        Start Application
                    </a>
                    <a href="{{ route('pages.show', 'contact') }}"
                        class="bg-blue-600/50 text-white px-10 py-5 rounded-2xl font-bold hover:bg-blue-600 transition-all border border-blue-400/30">
                        Inquire Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection