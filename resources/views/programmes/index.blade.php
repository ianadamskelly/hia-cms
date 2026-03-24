@extends('layouts.app')

@section('title', 'Our Academic Programmes')
@section('meta_description', 'Discover the diverse learning pathways and academic programmes at Hilal International Academy, from early years to secondary excellence.')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[45vh] min-h-[450px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2104&auto=format&fit=crop" 
                 class="w-full h-full object-cover scale-105" 
                 alt="HIA Academic Excellence">
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/70 via-blue-900/50 to-white/10"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-100 uppercase bg-blue-500/30 backdrop-blur-md rounded-full border border-blue-400/30 animate-fade-in-up">
                World-Class Education
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight animate-fade-in-up" style="animation-delay: 0.1s">
                Academic <span class="text-blue-300">Programmes</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-50 max-w-2xl mx-auto font-medium leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s">
                Empowering students through diverse learning pathways designed for global citizenship and future success.
            </p>
        </div>
    </section>

    <!-- Programmes Grid -->
    <section class="relative z-20 -mt-16 pb-24 px-4 overflow-visible">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programmes as $programme)
                    @php 
                        $image = $programme->getFirstMediaUrl('featured_image'); 
                    @endphp
                    
                    <article class="group relative flex flex-col bg-white/90 backdrop-blur-xl border border-gray-100 rounded-4xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden hover:-translate-y-2">
                        <!-- Image Container -->
                        <div class="relative h-64 w-full overflow-hidden">
                            <img src="{{ $image ?: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1722&auto=format&fit=crop' }}" 
                                 alt="{{ $programme->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Age Range Overlay -->
                            @if($programme->age_range)
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/50 shadow-lg">
                                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ $programme->age_range }}</span>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex-1 flex flex-col">
                            <h2 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-blue-700 transition-colors leading-tight">
                                <a href="{{ route('programmes.show', $programme->slug) }}">
                                    {{ $programme->name }}
                                </a>
                            </h2>

                            @if($programme->excerpt)
                                <p class="text-gray-600 mb-8 line-clamp-3 text-sm leading-relaxed font-medium">
                                    {{ $programme->excerpt }}
                                </p>
                            @endif

                            <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                <a href="{{ route('programmes.show', $programme->slug) }}" 
                                   class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition-all group/link">
                                    Explore Pathway
                                    <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                                
                                <span class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 opacity-0 group-hover:opacity-100 transition-all translate-x-4 group-hover:translate-x-0">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-7xl mx-auto px-4 pb-24">
        <div class="bg-blue-600 rounded-4xl p-12 relative overflow-hidden text-center text-white shadow-2xl shadow-blue-500/20">
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-black mb-6">Unsure which programme fits?</h2>
                <p class="text-blue-100 text-lg mb-8 font-medium">Our admissions team is here to guide you through our curriculum and help find the perfect pathway for your child.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact.show') }}" class="px-8 py-4 bg-white text-blue-600 rounded-2xl font-black hover:bg-blue-50 transition-colors uppercase tracking-widest text-xs">
                        Contact Admissions
                    </a>
                    <a href="{{ route('pages.show', 'about-us') }}" class="px-8 py-4 bg-blue-700 text-white rounded-2xl font-black hover:bg-blue-800 transition-colors uppercase tracking-widest text-xs border border-blue-500/30">
                        Learn Our Identity
                    </a>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -tranylate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 tranylate-y-1/2 -translate-x-1/2 w-64 h-64 bg-blue-300/10 rounded-full blur-3xl"></div>
        </div>
    </section>
@endsection