@extends('layouts.app')

@section('title', 'News & Perspectives')
@section('meta_description', 'The latest stories, academic achievements, and community updates from Hilal International Academy.')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[500px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=2069&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="HIA News Background">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-950 via-blue-900/60 to-transparent"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 w-full">
            <div class="max-w-2xl">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-100 uppercase bg-blue-500/30 backdrop-blur-md rounded-full border border-blue-400/30 animate-fade-in-up">
                    Media & Updates
                </span>
                <h1 class="text-4xl md:text-7xl font-black text-white mb-8 tracking-tight animate-fade-in-up" style="animation-delay: 0.1s">
                    School <span class="text-blue-300">News</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-50 font-medium leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s">
                    Voices from our community, celebrating achievement and sharing our global perspective.
                </p>
            </div>
        </div>
    </section>

    <!-- News Grid & Featured -->
    <section class="relative z-20 -mt-20 pb-24 px-4 overflow-visible">
        <div class="max-w-7xl mx-auto">
            @if($posts->count())
                @php $featured = $posts->first(); $rest = $posts->skip(1); @endphp

                <!-- Featured Story -->
                <article class="group relative bg-white rounded-5xl shadow-2xl overflow-hidden mb-16 border border-gray-100 flex flex-col lg:flex-row transition-all duration-500 hover:shadow-blue-900/10">
                    <div class="lg:w-3/5 relative h-80 lg:h-auto overflow-hidden">
                        <img src="{{ $featured->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' }}" 
                             alt="{{ $featured->title }}" 
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent"></div>
                    </div>
                    <div class="lg:w-2/5 p-10 lg:p-14 flex flex-col">
                        <div class="flex items-center gap-3 mb-6">
                            @if($featured->category)
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100 shadow-sm">
                                    {{ $featured->category->name }}
                                </span>
                            @endif
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Featured Story</span>
                        </div>
                        
                        <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-6 group-hover:text-blue-700 transition-colors leading-tight">
                            <a href="{{ route('posts.show', $featured->slug) }}">
                                {{ $featured->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-8 font-medium leading-relaxed line-clamp-4">
                            {{ $featured->excerpt }}
                        </p>

                        <div class="mt-auto flex items-center justify-between pt-8 border-t border-gray-50">
                            <div class="flex items-center gap-3">
                                @if($featured->author)
                                    <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white shadow-sm overflow-hidden text-blue-700 flex items-center justify-center font-black text-xs">
                                        {{ substr($featured->author->name, 0, 1) }}
                                    </div>
                                    <div class="text-xs">
                                        <p class="font-black text-gray-900">{{ $featured->author->name }}</p>
                                        <p class="text-gray-400">{{ $featured->published_at?->format('M d, Y') }}</p>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('posts.show', $featured->slug) }}" class="p-4 bg-gray-900 text-white rounded-2xl hover:bg-blue-700 transition-all shadow-lg active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- More News Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($rest as $post)
                        @php $postImage = $post->getFirstMediaUrl('featured_image'); @endphp
                        <article class="group flex flex-col bg-white rounded-4xl border border-gray-50 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden hover:-translate-y-2">
                            <div class="relative h-60 overflow-hidden">
                                <img src="{{ $postImage ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @if($post->category)
                                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-3 py-1 rounded-full border border-white/50 shadow-sm">
                                        <span class="text-[9px] font-black text-blue-700 uppercase tracking-widest">{{ $post->category->name }}</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
                            </div>
                            
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                    <span>{{ $post->published_at?->format('F d, Y') }}</span>
                                    @if($post->author)
                                        <span>•</span>
                                        <span>BY {{ $post->author->name }}</span>
                                    @endif
                                </div>

                                <h3 class="text-xl font-black text-gray-900 mb-4 group-hover:text-blue-700 transition-colors leading-snug line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6">
                                    {{ $post->excerpt }}
                                </p>

                                <div class="mt-auto pt-6 border-t border-gray-50">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 text-xs font-black text-blue-600 hover:text-blue-800 transition-all group/link uppercase tracking-widest">
                                        Read Narrative
                                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-20 flex justify-center">
                    {{ $posts->links() }}
                </div>

            @else
                <div class="max-w-2xl mx-auto px-8 py-20 bg-white rounded-4xl shadow-sm border border-gray-100 text-center">
                    <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-8">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4">No stories yet.</h3>
                    <p class="text-gray-500 font-medium">We're currently gathering perspectives and highlights. Stay tuned for updates from our academic journey.</p>
                </div>
            @endif
        </div>
    </section>
@endsection