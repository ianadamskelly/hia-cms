@extends('layouts.app')

@section('title', $download->seo_title ?: $download->title)
@section('meta_description', $download->seo_description ?: ($download->description ?? 'Download resource from Hilal International Academy'))

@section('content')
    <section class="bg-blue-50 border-b">
        <div class="max-w-5xl mx-auto px-4 py-16">
            @if($download->category)
                <p class="text-sm font-semibold uppercase tracking-wide text-blue-700 mb-3">
                    {{ $download->category->name }}
                </p>
            @endif

            <h1 class="text-4xl font-bold text-gray-900">{{ $download->title }}</h1>

            @if($download->description)
                <p class="mt-6 text-lg text-gray-600 max-w-3xl">
                    {{ $download->description }}
                </p>
            @endif
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white border rounded-2xl p-8 shadow-sm">
            <p class="text-sm text-gray-500">
                Type: {{ $download->file_type ?? 'Unknown' }}
            </p>

            @if($download->file_size)
                <p class="text-sm text-gray-500 mt-2">
                    Size: {{ number_format($download->file_size / 1024, 1) }} KB
                </p>
            @endif

            <div class="mt-6">
                <a href="{{ $download->file_url }}"
                    class="inline-flex items-center bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800"
                    target="_blank">
                    Download File
                </a>
            </div>
        </div>

        <div class="mt-12">
            <a href="{{ route('downloads.index') }}" class="text-blue-700 font-semibold hover:underline">
                ← Back to Downloads
            </a>
        </div>
    </section>
@endsection