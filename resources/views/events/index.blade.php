@extends('layouts.app')

@section('title', 'School Events & Updates')
@section('meta_description', 'Stay updated with the latest events, academic milestones, and community activities at Hilal International Academy.')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[400px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1523050335392-9bef8183091e?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover scale-105" 
                 alt="HIA Events Background">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/60 via-blue-900/40 to-white/10"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-100 uppercase bg-blue-500/30 backdrop-blur-md rounded-full border border-blue-400/30 animate-fade-in-up">
                Calendar & Community
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight animate-fade-in-up" style="animation-delay: 0.1s">
                School <span class="text-blue-300">Events</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-50 max-w-2xl mx-auto font-medium leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s">
                Explore upcoming activities, academic milestones, and important dates that shape our vibrant school community.
            </p>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="relative z-20 -mt-12 pb-24 px-4 overflow-visible">
        <div class="max-w-7xl mx-auto">
            @if($events->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events as $event)
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
                        
                        <article class="group relative flex flex-col bg-white/80 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden hover:-translate-y-2">
                            <!-- Image Container -->
                            <div class="relative h-56 w-full overflow-hidden">
                                <img src="{{ $featuredImage ?: 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1840&auto=format&fit=crop' }}" 
                                     alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <!-- Date Badge Overlay -->
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-2 rounded-2xl border border-white/50 shadow-lg text-center min-w-[60px]">
                                    <span class="block text-xs font-bold text-blue-600 uppercase tracking-tighter">{{ $event->start_at?->format('M') }}</span>
                                    <span class="block text-xl font-black text-gray-900 leading-none">{{ $event->start_at?->format('d') }}</span>
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm border border-{{ $color }}-200 bg-{{ $color }}-100 text-{{ $color }}-700">
                                        {{ $event->type ?: 'Event' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    <svg class="w-4 h-4 text-{{ $color }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $event->start_at?->format('g:i A') }}
                                    @if($event->location)
                                        <span class="mx-1">•</span>
                                        <span class="truncate max-w-[150px]">{{ $event->location }}</span>
                                    @endif
                                </div>

                                <h2 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors leading-tight">
                                    <a href="{{ route('events.show', $event->slug) }}">
                                        {{ $event->title }}
                                    </a>
                                </h2>

                                @if($event->excerpt)
                                    <p class="text-gray-600 mb-8 line-clamp-3 text-sm leading-relaxed font-medium">
                                        {{ $event->excerpt }}
                                    </p>
                                @endif

                                <div class="mt-auto pt-6 border-t border-gray-50">
                                    <a href="{{ route('events.show', $event->slug) }}" 
                                       class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition-all group/link">
                                        View Full Event 
                                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16 flex justify-center">
                    {{ $events->links() }}
                </div>
            @else
                <div class="max-w-xl mx-auto px-8 py-16 bg-white rounded-3xl shadow-sm border border-gray-100 text-center">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Upcoming Events</h3>
                    <p class="text-gray-500 font-medium">We're currently planning exciting activities. Please check back later or view our academic calendar.</p>
                    <a href="{{ route('calendar.index') }}" class="mt-8 inline-block bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors">
                        View Academic Calendar
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection