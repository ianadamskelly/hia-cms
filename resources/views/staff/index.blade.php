@extends('layouts.app')

@section('title', 'Leadership & Staff')
@section('meta_description', 'Meet our leadership team and key staff members.')

@section('content')
    <section class="bg-blue-50 border-b">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold text-gray-900">Leadership & Staff</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                Meet the people who help shape the learning experience and school community.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($staffMembers as $member)
                @php $image = $member->getFirstMediaUrl('profile_image'); @endphp

                <article class="overflow-hidden border rounded-2xl shadow-sm bg-white">
                    @if($image)
                        <img src="{{ $image }}" alt="{{ $member->name }}" class="h-64 w-full object-cover">
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-bold">
                            <a href="{{ route('staff.show', $member->slug) }}" class="hover:text-blue-700">
                                {{ $member->name }}
                            </a>
                        </h2>

                        @if($member->title)
                            <p class="mt-2 text-sm font-medium text-blue-700">
                                {{ $member->title }}
                            </p>
                        @endif

                        @if($member->department)
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $member->department }}
                            </p>
                        @endif

                        @if($member->excerpt)
                            <p class="mt-4 text-gray-600 text-sm">
                                {{ $member->excerpt }}
                            </p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection