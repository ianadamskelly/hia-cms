@extends('layouts.app')

@php
    $heroImage = $page->getFirstMediaUrl('hero_image') ?: asset('images/hero_campus.png');
@endphp

@section('title', $page->seo_title ?: 'About HIA - Hilal International Academy')
@section('meta_description', $page->seo_description ?: 'Discover the heart of innovative learning in the Horn of Africa.')

@section('content')
    {{-- Immersive Hero Section --}}
    <section class="relative h-[60vh] min-h-[400px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $heroImage }}" alt="Hilal International Academy Campus" class="w-full h-full object-cover brightness-50">
            <div class="absolute inset-0 bg-linear-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10 text-white animate-fade-in-up">
            <div class="max-w-3xl">
                @include('partials.breadcrumbs', [
                    'items' => [['label' => 'About Us']]
                ])
                <h1 class="text-5xl md:text-7xl font-bold mt-6 text-balance">
                    The Pioneer of <span class="text-blue-400">Innovative Learning</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-200 mt-6 leading-relaxed max-w-2xl font-light">
                    Founded in 2018, HIA represents a new era of educational excellence in Somalia, blending global standards with local values.
                </p>
            </div>
        </div>
    </section>

    {{-- Intro Section --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-in-up">
                    <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Who We Are</span>
                    <h2 class="text-4xl font-bold text-slate-900 mt-4 leading-tight">Hilal International Academy: An Integrated Learning Journey</h2>
                    <div class="mt-8 space-y-6 text-slate-600 text-lg leading-relaxed">
                        <p>
                            Hilal International Academy is an integrated school in Mogadishu, Somalia, established in 2018 by leading academicians and professionals. Our core mission is to provide unique and quality educational services for children aged 3 to 18 years.
                        </p>
                        <p>
                            With campuses in both Hiliwaa and Wadajir districts, we offer a dual-shift system that harmonizes international curriculums with Holy Quran and Islamic studies, ensuring our students grow as knowledgeable and spiritually grounded individuals.
                        </p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-4 bg-blue-100 rounded-2xl rotate-3 group-hover:rotate-1 transition-transform duration-500"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/hero_campus.png') }}" alt="HIA Learning Environment" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision & Mission --}}
    <section class="py-24 bg-slate-50 relative">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Vision Card --}}
                <div class="glass-blur p-12 rounded-3xl border border-white shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-900 mb-6">Our Vision</h3>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        To be a safe learning environment in which pupils are empowered to seek, acquire, and demonstrate knowledge, skills and values that will serve them and their communities in the future.
                    </p>
                </div>

                {{-- Mission Card --}}
                <div class="glass-blur p-12 rounded-3xl border border-white shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg shadow-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-900 mb-6">Our Mission</h3>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        To provide a progressive education that enables learners to attain their full potential as responsible, productive, creative, and compassionate global citizens.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Principal's Message --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-slate-900 text-white flex flex-col md:flex-row items-center">
                <div class="w-full md:w-2/5 h-[400px] md:h-auto self-stretch">
                    <img src="{{ asset('images/principal.png') }}" alt="Mohammed Isabirye - Principal" class="w-full h-full object-cover object-top brightness-90">
                </div>
                <div class="w-full md:w-3/5 p-12 md:p-16 relative">
                    <div class="absolute top-8 right-8 text-blue-500/20">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V3L14.017 2H19.017C20.6739 2 22.017 3.34315 22.017 5V15C22.017 16.6569 20.6739 18 19.017 18H17.017L17.017 21H14.017ZM3.0166 21L3.0166 18C3.0166 16.8954 3.91203 16 5.0166 16H8.0166C8.56888 16 9.0166 15.5523 9.0166 15V9C9.0166 8.44772 8.56888 8 8.0166 8H5.0166C3.91203 8 3.0166 7.10457 3.0166 6V3L3.0166 2H8.0166C9.67345 2 11.0166 3.34315 11.0166 5V15C11.0166 16.6569 9.67345 18 8.0166 18H6.0166L6.0166 21H3.0166Z"/></svg>
                    </div>
                    <span class="text-blue-400 font-medium tracking-widest uppercase text-sm">Principal's Greeting</span>
                    <h2 class="text-4xl font-bold mt-4 mb-8">A Message to Our Community</h2>
                    <div class="space-y-6 text-slate-300 text-lg leading-relaxed italic">
                        <p>
                            "I am delighted to extend a warm welcome to our vibrant and exceptional school community. At Hilal International Academy, our commitment goes beyond preparing students for top universities and successful careers."
                        </p>
                        <p>
                            "We take pride in nurturing well-rounded, globally aware, and critical thinkers who are innovative, empathetic, and ready to make a meaningful impact on the world. We are thrilled about your interest in becoming part of the HIA community."
                        </p>
                    </div>
                    <div class="mt-12">
                        <p class="text-xl font-bold text-white">Mohammed Isabirye</p>
                        <p class="text-blue-400">Principal, Hilal International Academy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Value Grid --}}
    <section class="py-24 bg-slate-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-semibold tracking-wider uppercase text-sm">Core Institutional Values</span>
                <h2 class="text-4xl font-bold text-slate-900 mt-4">The Pillars of Our Success</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                @php
                    $values = [
                        ['title' => 'Professionalism', 'color' => 'blue', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'desc' => 'Highest standards of excellence.'],
                        ['title' => 'Integrity', 'color' => 'indigo', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'desc' => 'Trustworthy, faithful and honest.'],
                        ['title' => 'Diversity', 'color' => 'violet', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'desc' => 'Celebrating unique backgrounds.'],
                        ['title' => 'Collaboration', 'color' => 'sky', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'desc' => 'Nurturing stakeholder partnerships.'],
                        ['title' => 'Ethics', 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'desc' => 'Respecting human rights and dignity.'],
                        ['title' => 'Accountability', 'color' => 'rose', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'desc' => 'Responsible for our decisions.'],
                        ['title' => 'Innovation', 'color' => 'amber', 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'desc' => 'Transforming educational needs.'],
                        ['title' => 'Excellence', 'color' => 'cyan', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z', 'desc' => 'Professional personal growth.'],
                        ['title' => 'Caring', 'color' => 'pink', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'desc' => 'Positive and supportive environment.'],
                        ['title' => 'Community', 'color' => 'teal', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'desc' => 'Shared knowledge and skills.'],
                    ];
                @endphp

                @foreach($values as $value)
                    <div class="glass-dark p-6 rounded-2xl border border-white/10 hover:border-{{ $value['color'] }}-400/30 transition-all duration-300 group">
                        <div class="w-12 h-12 bg-{{ $value['color'] }}-500/10 rounded-xl flex items-center justify-center text-{{ $value['color'] }}-500 mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"/></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm mb-2">{{ $value['title'] }}</h4>
                        <p class="text-xs text-slate-500 leading-tight">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-blue-600 rounded-[2.5rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl shadow-blue-200">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/hero_campus.png') }}" class="w-full h-full object-cover opacity-10 blur-sm scale-110" alt="">
                </div>
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-8">Join the HIA Legacy</h2>
                    <p class="text-xl text-blue-100 mb-12 leading-relaxed">
                        Become part of Mogadishu's most innovative learning community. Admissions are open for all IB programmes.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('admissions.form') }}" class="px-10 py-5 bg-white text-blue-600 font-bold rounded-2xl hover:bg-blue-50 transition-all shadow-lg hover:shadow-xl">
                            Apply for Admission
                        </a>
                        <a href="{{ route('contact.show') }}" class="px-10 py-5 bg-transparent border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 transition-all">
                            Visit Our Campus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
