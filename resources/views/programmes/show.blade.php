@extends('layouts.app')

@php 
    $image = $programme->getFirstMediaUrl('featured_image'); 
@endphp

@section('title', $programme->seo_title ?: $programme->name)
@section('meta_description', $programme->seo_description ?: ($programme->excerpt ?? 'Programme details'))

@section('og_title', $programme->seo_title ?: $programme->name)
@section('og_description', $programme->seo_description ?: ($programme->excerpt ?? 'Programme details'))

@if($image)
    @section('og_image', $image)
@endif

@section('content')
    <!-- Immersive Header Section -->
    <section class="relative h-[60vh] min-h-[500px] flex items-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $image ?: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1722&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover scale-105" 
                 alt="{{ $programme->name }}">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
            <div class="absolute inset-0 backdrop-blur-[1px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 pb-16 w-full">
            <div class="max-w-4xl">
                <nav class="flex mb-8 text-blue-200/80 font-bold text-xs uppercase tracking-widest no-print" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li><a href="{{ route('programmes.index') }}" class="hover:text-white transition-colors">Programmes</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li class="text-white truncate max-w-[200px]">{{ $programme->name }}</li>
                    </ol>
                </nav>

                <div class="flex items-center gap-3 mb-6">
                    @if($programme->age_range)
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-500 text-white shadow-lg border border-blue-400/30">
                            Age Range: {{ $programme->age_range }}
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-7xl font-black text-white mb-8 leading-tight tracking-tight">
                    {{ $programme->name }}
                </h1>
            </div>
        </div>
    </section>

    <!-- Content & Highlights -->
    <section class="max-w-7xl mx-auto px-4 py-12 lg:py-24">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            
            <!-- Main Content -->
            <div class="lg:col-span-8">
                @if($programme->excerpt)
                    <div class="bg-blue-50/50 p-8 rounded-3xl border border-blue-100 mb-12 shadow-sm italic">
                        <p class="text-xl text-blue-900 font-medium leading-relaxed">
                            "{{ $programme->excerpt }}"
                        </p>
                    </div>
                @endif

                <article class="prose prose-lg prose-blue max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:leading-relaxed prose-p:text-gray-600 prose-strong:text-gray-900 font-medium">
                    {!! $programme->description !!}
                </article>

                <!-- Back Action -->
                <div class="mt-16 pt-12 border-t border-gray-100 no-print">
                    <a href="{{ route('programmes.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-2xl font-bold hover:bg-gray-800 transition-all group shadow-lg shadow-gray-900/10">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        View All Programmes
                    </a>
                </div>
            </div>

            <!-- Sidebar Info Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white rounded-4xl border border-gray-100 shadow-xl overflow-hidden sticky top-8">
                    <div class="bg-blue-600 p-8 text-white relative">
                        <p class="text-xs font-bold uppercase tracking-widest text-blue-100 mb-2">Programme Summary</p>
                        <h3 class="text-2xl font-black tracking-tight">Key Information</h3>
                    </div>
                    
                    <div class="p-8 space-y-8 font-medium">
                        <!-- Age Range Iconified -->
                        @if($programme->age_range)
                            <div class="flex gap-4">
                                <div class="shrink-0 w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 border border-blue-100 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Recommended Age</p>
                                    <p class="text-lg text-gray-900 font-bold leading-tight">{{ $programme->age_range }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Inquire Action -->
                        <div class="pt-8 border-t border-gray-100 space-y-4 no-print">
                            <a href="{{ route('contact.show') }}" class="w-full flex items-center justify-center gap-2 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black transition-all shadow-lg shadow-blue-500/20 uppercase tracking-widest text-xs">
                                Inquire About Admission
                            </a>
                            <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 py-4 bg-gray-50 hover:bg-gray-100 text-gray-900 rounded-2xl font-black transition-colors border border-gray-200 uppercase tracking-widest text-xs">
                                Download Prospectus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection