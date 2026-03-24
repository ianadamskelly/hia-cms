@extends('layouts.app')

@php
    $heroImage = $page->getFirstMediaUrl('hero_image');
@endphp

@section('title', $page->seo_title ?: $page->title)
@section('meta_description', $page->seo_description ?: ($page->excerpt ?? 'Hilal International Academy'))

@section('og_title', $page->seo_title ?: $page->title)
@section('og_description', $page->seo_description ?: ($page->excerpt ?? 'Page'))
@if($heroImage)
    @section('og_image', $heroImage)
@endif

@section('content')

    <section class="bg-blue-50 border-b">
        <div class="max-w-5xl mx-auto px-4 py-16">
            @include('partials.breadcrumbs', [
                'items' => [
                    ['label' => $page->title],
                ]
            ])

            <h1 class="text-4xl font-bold text-gray-900">{{ $page->title }}</h1>

            @if($page->excerpt)
                <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                    {{ $page->excerpt }}
                </p>
            @endif
        </div>
    </section>

    @if($heroImage)
        <section class="max-w-5xl mx-auto px-4 pt-10">
            <div class="overflow-hidden rounded-2xl shadow-sm">
                <img src="{{ $heroImage }}" alt="{{ $page->title }}" class="w-full h-[420px] object-cover">
            </div>
        </section>
    @endif

    <section class="max-w-5xl mx-auto px-4 py-12">
        <article class="prose prose-lg max-w-none">
            {!! $page->content !!}
        </article>
    </section>
@endsection