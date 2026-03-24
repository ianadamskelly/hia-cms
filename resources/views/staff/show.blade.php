@extends('layouts.app')

@php $image = $staff->getFirstMediaUrl('profile_image'); @endphp

@section('title', $staff->seo_title ?: $staff->name)
@section('meta_description', $staff->seo_description ?: ($staff->excerpt ?? 'Staff profile'))

@section('og_title', $staff->seo_title ?: $staff->name)
@section('og_description', $staff->seo_description ?: ($staff->excerpt ?? 'Staff profile'))
@if($image)
    @section('og_image', $image)
@endif

@section('content')

    <section class="bg-blue-50 border-b">
        <div class="max-w-5xl mx-auto px-4 py-16">
            @include('partials.breadcrumbs', [
                'items' => [
                    ['label' => 'Staff Explorer', 'url' => route('staff.index')],
                    ['label' => $staff->name],
                ]
            ])

            <h1 class="text-4xl font-bold text-gray-900">{{ $staff->name }}</h1>

            @if($staff->title)
                <p class="mt-3 text-lg font-medium text-blue-700">{{ $staff->title }}</p>
            @endif

            @if($staff->department)
                <p class="mt-2 text-sm text-gray-500">{{ $staff->department }}</p>
            @endif

            @if($staff->excerpt)
                <p class="mt-6 text-lg text-gray-600 max-w-3xl">
                    {{ $staff->excerpt }}
                </p>
            @endif
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-12 grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-1">
            @if($image)
                <div class="overflow-hidden rounded-2xl shadow-sm">
                    <img src="{{ $image }}" alt="{{ $staff->name }}" class="w-full h-[420px] object-cover">
                </div>
            @endif
        </div>

        <div class="lg:col-span-2">
            <article class="prose prose-lg max-w-none">
                {!! $staff->bio !!}
            </article>

            <div class="mt-8 space-y-2 text-sm text-gray-600">
                @if($staff->email)
                    <p><strong>Email:</strong> {{ $staff->email }}</p>
                @endif

                @if($staff->phone)
                    <p><strong>Phone:</strong> {{ $staff->phone }}</p>
                @endif
            </div>
        </div>
    </section>
@endsection