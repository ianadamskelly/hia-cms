@extends('layouts.app')

@php
    $featuredImage = $event->getFirstMediaUrl('featured_image');
    $typeColors = [
        'academic' => 'blue',
        'holiday' => 'red',
        'exam' => 'purple',
        'event' => 'green',
        'staff' => 'amber',
    ];
    $color = $typeColors[$event->type] ?? 'blue';
@endphp

@section('title', $event->seo_title ?: $event->title)
@section('meta_description', $event->seo_description ?: ($event->excerpt ?? 'Event at Hilal International Academy'))

@section('og_title', $event->seo_title ?: $event->title)
@section('og_description', $event->seo_description ?: ($event->excerpt ?? 'Event update'))
@if($featuredImage)
    @section('og_image', $featuredImage)
@endif

@section('content')
    <!-- Immersive Header Section -->
    <section class="relative h-[60vh] min-h-[500px] flex items-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $featuredImage ?: 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1840&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover scale-105" 
                 alt="{{ $event->title }}">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
            <div class="absolute inset-0 backdrop-blur-[1px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 pb-16 w-full">
            <div class="max-w-4xl">
                <nav class="flex mb-8 text-blue-200/80 font-bold text-xs uppercase tracking-widest no-print" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-white transition-colors">Events</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li class="text-white truncate max-w-[200px]">{{ $event->title }}</li>
                    </ol>
                </nav>

                <div class="flex items-center gap-3 mb-6">
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-{{ $color }}-500 text-white shadow-lg border border-{{ $color }}-400/30">
                        {{ $event->type ?: 'Event' }}
                    </span>
                    @if($event->is_featured)
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-500 text-white shadow-lg border border-amber-400/30 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            Featured
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tight">
                    {{ $event->title }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Content & Info Panels -->
    <section class="max-w-7xl mx-auto px-4 py-12 lg:py-24">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            
            <!-- Main Content -->
            <div class="lg:col-span-8">
                @if($event->excerpt)
                    <div class="bg-blue-50/50 p-8 rounded-3xl border border-blue-100 mb-12 shadow-sm italic">
                        <p class="text-xl text-blue-900 font-medium leading-relaxed">
                            "{{ $event->excerpt }}"
                        </p>
                    </div>
                @endif

                <article class="prose prose-lg prose-blue max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:leading-relaxed prose-p:text-gray-600 prose-strong:text-gray-900 font-medium">
                    {!! $event->description !!}
                </article>

                <!-- Back Action -->
                <div class="mt-16 pt-12 border-t border-gray-100 no-print">
                    <a href="{{ route('events.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-2xl font-bold hover:bg-gray-800 transition-all group shadow-lg shadow-gray-900/10">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to All Events
                    </a>
                </div>
            </div>

            <!-- Sidebar Info Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Info Card -->
                <div class="bg-white rounded-4xl border border-gray-100 shadow-xl overflow-hidden sticky top-8">
                    <div class="bg-{{ $color }}-600 p-8 text-white relative">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-widest text-{{ $color }}-100 mb-2">Event Schedule</p>
                        <h3 class="text-2xl font-black tracking-tight">Time & Location</h3>
                    </div>
                    
                    <div class="p-8 space-y-8 font-medium">
                        <!-- Date & Time -->
                        <div class="flex gap-4">
                            <div class="shrink-0 w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 border border-blue-100 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Date</p>
                                <p class="text-lg text-gray-900 font-bold leading-tight">
                                    {{ $event->start_at?->format('l, F j, Y') }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $event->start_at?->format('g:i A') }}
                                    @if($event->end_at)
                                        — {{ $event->end_at->format('g:i A') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Location -->
                        @if($event->location)
                            <div class="flex gap-4">
                                <div class="shrink-0 w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 border border-green-100 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Location</p>
                                    <p class="text-lg text-gray-900 font-bold leading-tight">
                                        {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="pt-8 border-t border-gray-100 space-y-4 no-print">
                            <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 py-4 bg-gray-50 hover:bg-gray-100 text-gray-900 rounded-2xl font-black transition-colors border border-gray-200 uppercase tracking-widest text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Print Details
                            </button>
                            <a href="{{ route('calendar.index') }}" class="w-full flex items-center justify-center gap-2 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black transition-all shadow-lg shadow-blue-500/20 uppercase tracking-widest text-xs">
                                View Academic Calendar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection