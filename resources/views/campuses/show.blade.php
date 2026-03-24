@extends('layouts.app')

@php $image = $campus->getFirstMediaUrl('featured_image'); @endphp

@section('title', $campus->seo_title ?: $campus->name)
@section('meta_description', $campus->seo_description ?: ($campus->excerpt ?? 'Campus details'))

@section('og_title', $campus->seo_title ?: $campus->name)
@section('og_description', $campus->seo_description ?: ($campus->excerpt ?? 'Campus details'))
@if($image)
    @section('og_image', $image)
@endif

@section('content')

    <section class="bg-blue-50 border-b">
        <div class="max-w-5xl mx-auto px-4 py-16">
            @include('partials.breadcrumbs', [
                'items' => [
                    ['label' => 'Campuses', 'url' => route('campuses.index')],
                    ['label' => $campus->name],
                ]
            ])

            <h1 class="text-4xl font-bold text-gray-900">{{ $campus->name }}</h1>

            @if($campus->excerpt)
                <p class="mt-6 text-lg text-gray-600 max-w-3xl">
                    {{ $campus->excerpt }}
                </p>
            @endif
        </div>
    </section>

    @if($image)
        <section class="max-w-5xl mx-auto px-4 pt-10">
            <div class="overflow-hidden rounded-2xl shadow-sm">
                <img src="{{ $image }}" alt="{{ $campus->name }}" class="w-full h-[420px] object-cover">
            </div>
        </section>
    @endif

    <section class="max-w-5xl mx-auto px-4 py-12 grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2">
            <article class="prose prose-lg max-w-none">
                {!! $campus->description !!}
            </article>
        </div>

        <aside class="space-y-6">
            <div class="border rounded-2xl p-6 bg-white shadow-sm">
                <h2 class="text-lg font-bold">Contact</h2>

                @if($campus->address)
                    <p class="mt-4 text-sm text-gray-600">{{ $campus->address }}</p>
                @endif

                @if($campus->email)
                    <p class="mt-3 text-sm text-gray-600">{{ $campus->email }}</p>
                @endif

                @if($campus->phone_primary)
                    <p class="mt-3 text-sm text-gray-600">{{ $campus->phone_primary }}</p>
                @endif

                @if($campus->phone_secondary)
                    <p class="mt-3 text-sm text-gray-600">{{ $campus->phone_secondary }}</p>
                @endif
            </div>

            @if($campus->working_hours)
                <div class="border rounded-2xl p-6 bg-white shadow-sm">
                    <h2 class="text-lg font-bold">Working Hours</h2>
                    <div class="mt-4 text-sm text-gray-600 whitespace-pre-line">
                        {{ $campus->working_hours }}
                    </div>
                </div>
            @endif
        </aside>
    </section>

    @if($campus->map_embed)
        <section class="max-w-5xl mx-auto px-4 pb-12">
            <div class="overflow-hidden rounded-2xl border shadow-sm">
                {!! $campus->map_embed !!}
            </div>
        </section>
    @endif
@endsection