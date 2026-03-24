@extends('layouts.app')

@section('title', 'Downloads')
@section('meta_description', 'Documents, forms, and downloadable resources from Hilal International Academy.')

@section('content')
    <section class="bg-blue-50 border-b">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold text-gray-900">Downloads</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                Access important documents, forms, handbooks, and school resources.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        @if($downloads->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($downloads as $download)
                    <article class="border rounded-2xl shadow-sm p-6 bg-white">
                        @if($download->category)
                            <p class="text-sm font-medium text-blue-700 mb-3">
                                {{ $download->category->name }}
                            </p>
                        @endif

                        <h2 class="text-xl font-bold text-gray-900">
                            <a href="{{ route('downloads.show', $download->slug) }}" class="hover:text-blue-700">
                                {{ $download->title }}
                            </a>
                        </h2>

                        @if($download->description)
                            <p class="mt-4 text-gray-600">
                                {{ $download->description }}
                            </p>
                        @endif

                        <p class="mt-4 text-sm text-gray-500">
                            {{ $download->file_type ?? 'File' }}
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('downloads.show', $download->slug) }}"
                                class="inline-flex items-center text-blue-700 font-semibold hover:underline">
                                View file
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $downloads->links() }}
            </div>
        @else
            <div class="border rounded-2xl p-8 bg-white text-center text-gray-600">
                No downloads published yet.
            </div>
        @endif
    </section>
@endsection