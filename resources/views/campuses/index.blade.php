@extends('layouts.app')

@section('title', 'Campuses')
@section('meta_description', 'Explore our campuses.')

@section('content')
    <section class="bg-blue-50 border-b">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold text-gray-900">Our Campuses</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                Explore our welcoming campus environments.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campuses as $campus)
                @php $image = $campus->getFirstMediaUrl('featured_image'); @endphp
                <article class="overflow-hidden border rounded-2xl shadow-sm bg-white">
                    @if($image)
                        <img src="{{ $image }}" alt="{{ $campus->name }}" class="h-52 w-full object-cover">
                    @endif
                    <div class="p-6">
                        <h2 class="text-xl font-bold">
                            <a href="{{ route('campuses.show', $campus->slug) }}" class="hover:text-blue-700">
                                {{ $campus->name }}
                            </a>
                        </h2>

                        @if($campus->excerpt)
                            <p class="mt-4 text-gray-600 text-sm">{{ $campus->excerpt }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
