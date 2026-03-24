@extends('layouts.app')

@php
    $featuredImage = $post->getFirstMediaUrl('featured_image');
@endphp

@section('title', $post->seo_title ?: $post->title)
@section('meta_description', $post->seo_description ?: ($post->excerpt ?? 'News update from Hilal International Academy'))

@section('og_title', $post->seo_title ?: $post->title)
@section('og_description', $post->seo_description ?: ($post->excerpt ?? 'News update'))
@if($featuredImage)
    @section('og_image', $featuredImage)
@endif

@section('content')
    <!-- Immersive editorial Header Section -->
    <section class="relative h-[65vh] min-h-[550px] flex items-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $featuredImage ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' }}" 
                 class="w-full h-full object-cover scale-105" 
                 alt="{{ $post->title }}">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-gray-900/50 to-transparent"></div>
            <div class="absolute inset-0 backdrop-blur-[1px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 pb-20 w-full">
            <div class="max-w-4xl">
                <nav class="flex mb-8 text-blue-200/80 font-bold text-xs uppercase tracking-widest no-print" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition-colors">News</a></li>
                        <li><span class="mx-2 text-blue-400">/</span></li>
                        <li class="text-white truncate max-w-[200px]">{{ $post->title }}</li>
                    </ol>
                </nav>

                <div class="flex items-center gap-4 mb-6">
                    @if($post->category)
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-600 text-white shadow-lg border border-white/20">
                            {{ $post->category->name }}
                        </span>
                    @endif
                    <span class="text-xs font-bold text-blue-100 uppercase tracking-widest">{{ $post->published_at?->format('F d, Y') }}</span>
                </div>

                <h1 class="text-4xl md:text-7xl font-black text-white mb-8 leading-tight tracking-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-4">
                    @if($post->author)
                        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white font-black">
                            {{ substr($post->author->name, 0, 1) }}
                        </div>
                        <div class="text-white">
                            <p class="text-xs font-black uppercase tracking-widest text-blue-200">Authored By</p>
                            <p class="text-lg font-bold">{{ $post->author->name }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Narrative Content -->
    <section class="max-w-7xl mx-auto px-4 py-12 lg:py-24">
        <div class="max-w-4xl mx-auto">
            @if($post->excerpt)
                <div class="bg-gray-50 p-10 rounded-4xl border border-gray-100 mb-16 relative">
                    <svg class="absolute top-0 left-0 w-20 h-20 text-gray-200 -translate-x-4 -translate-y-4 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.748-9.391 9-10.109V5.625c-3.111.758-5 3.036-5 6.012H23v9.363h-8.983zm-14 0v-7.391c0-5.704 3.748-9.391 9-10.109V5.625c-3.111.758-5 3.036-5 6.012H9v9.363H.017z"></path></svg>
                    <p class="text-2xl text-gray-900 font-bold leading-relaxed relative z-10 italic">
                        {{ $post->excerpt }}
                    </p>
                </div>
            @endif

            <article class="prose prose-xl prose-blue max-w-none prose-headings:font-black prose-headings:tracking-tight prose-p:leading-relaxed prose-p:text-gray-600 prose-strong:text-gray-900 font-medium">
                {!! $post->content !!}
            </article>

            <!-- Metadata & Social Actions -->
            <div class="mt-20 pt-12 border-t border-gray-100 flex flex-wrap items-center justify-between gap-8 no-print">
                <a href="{{ route('posts.index') }}" 
                   class="inline-flex items-center gap-2 px-8 py-4 bg-gray-900 text-white rounded-2xl font-black hover:bg-gray-800 transition-all group shadow-xl shadow-gray-900/10 uppercase tracking-widest text-xs">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to News Feed
                </a>
                
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share Narrative</span>
                    <div class="flex gap-2">
                        @foreach(['Twitter', 'LinkedIn', 'Facebook'] as $platform)
                            <button class="w-12 h-12 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-100 hover:bg-blue-50 transition-all shadow-sm">
                                <span class="sr-only">{{ $platform }}</span>
                                <div class="w-5 h-5 bg-current mask-{{ strtolower($platform) }} bg-no-repeat bg-center"></div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection