@extends('layouts.app')

@section('title', 'Connect with HIA')
@section('meta_description', 'Get in touch with Hilal International Academy. Our team is here to support your educational journey.')

@section('content')
    {{-- Immersive Hero Section --}}
    <section class="relative h-[45vh] min-h-[350px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_campus.png') }}" alt="HIA Campus" class="w-full h-full object-cover brightness-50">
            <div class="absolute inset-0 bg-linear-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10 text-white animate-fade-in-up">
            <div class="max-w-3xl">
                <span class="text-blue-400 font-medium tracking-widest uppercase text-xs mb-4 block">Get in Touch</span>
                <h1 class="text-5xl md:text-6xl font-bold text-balance leading-tight">
                    We're Here to <span class="text-blue-400">Support Your Journey</span>
                </h1>
                <p class="text-xl text-slate-200 mt-6 leading-relaxed max-w-2xl font-light">
                    Whether you have questions about admissions, our IB programs, or campus life, our team is ready to assist you.
                </p>
            </div>
        </div>
    </section>

    {{-- Contact Info Cards --}}
    <section class="py-12 bg-white -mt-16 relative z-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Email Card --}}
                <div class="glass-blur bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all group">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Email Us</h3>
                    <p class="text-slate-500 mb-6 text-sm">Our support team is available mon-fri 8am-5pm.</p>
                    <a href="mailto:info@hia.edu.so" class="text-blue-600 font-bold text-lg hover:text-blue-700 transition-colors">info@hia.edu.so</a>
                </div>

                {{-- Phone Card --}}
                <div class="glass-blur bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all group">
                    <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Call Us</h3>
                    <p class="text-slate-500 mb-4 text-sm">Direct lines to our administration for urgent inquiries.</p>
                    <div class="space-y-2">
                        <p class="font-bold text-slate-800">(252) 61 366-1515</p>
                        <p class="font-bold text-slate-800">(252) 61 166-2525</p>
                        <p class="font-bold text-slate-800">(252) 61 366-1616</p>
                    </div>
                </div>

                {{-- Location Card --}}
                <div class="glass-blur bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl transition-all group">
                    <div class="w-14 h-14 bg-teal-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-teal-200 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Our Campuses</h3>
                    <p class="text-slate-500 mb-6 text-sm">Visit us at our primary locations in Mogadishu.</p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <span class="w-2 h-2 rounded-full bg-teal-500 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold text-slate-900 text-sm">Heliwaa District</p>
                                <p class="text-xs text-slate-500">Mogadishu, Somalia</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-2 h-2 rounded-full bg-blue-500 mt-2 shrink-0"></span>
                            <div>
                                <p class="font-bold text-slate-900 text-sm">Banadir District</p>
                                <p class="text-xs text-slate-500">Wadajir, Mogadishu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Contact Section --}}
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-16">
                {{-- Form Column --}}
                <div class="w-full lg:w-3/5">
                    <div class="glass-blur bg-white p-10 md:p-12 rounded-[2.5rem] shadow-2xl shadow-slate-200 relative overflow-hidden border border-white">
                        <div class="relative z-10">
                            <h2 class="text-3xl font-bold text-slate-900 mb-4">Send us a Message</h2>
                            <p class="text-slate-500 mb-10">Have questions about admissions or school life? We're here to help.</p>
                            
                            @if(session('success'))
                                <div class="mb-8 rounded-2xl border border-emerald-100 bg-emerald-50 p-6 text-emerald-800 flex items-center gap-4 animate-fade-in-up">
                                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <p class="font-medium">{{ session('success') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 ml-1">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" 
                                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-hidden font-medium" required>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 ml-1">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com"
                                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-hidden font-medium">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 ml-1">Phone Number</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+252..."
                                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-hidden font-medium">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 ml-1">Subject</label>
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Admissions, General inquiry..."
                                            class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-hidden font-medium">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 ml-1">How can we help?</label>
                                    <textarea name="message" rows="5" placeholder="Tell us more about your inquiry..."
                                        class="w-full rounded-2xl border-slate-200 bg-slate-50/50 px-5 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-hidden font-medium" required>{{ old('message') }}</textarea>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="w-full md:w-auto px-12 py-5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 hover:shadow-2xl hover:-translate-y-1 active:translate-y-0">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Side Info Column --}}
                <div class="w-full lg:w-2/5 space-y-8 animate-fade-in-up">
                    <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full -mr-16 -mt-16 blur-2xl font-medium"></div>
                        <h3 class="text-2xl font-bold mb-6">Frequently Asked Questions</h3>
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-bold text-blue-400 mb-2">When do admissions open?</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">Admissions for the new academic year typically open in July. Please contact our registrar for specific dates.</p>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-400 mb-2">Which curriculum do you follow?</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">We are an Authorized IB World School offering PYP, MYP, and DP programs integrated with Islamic studies.</p>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-400 mb-2">Can we visit the campus?</h4>
                                <p class="text-slate-400 text-sm leading-relaxed">Yes, we welcome campus visits by appointment. Please send us a message to schedule a tour.</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-[2.5rem] p-10 bg-white">
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 font-medium">Office Hours</h3>
                        <ul class="space-y-4 font-medium">
                            <li class="flex justify-between items-center pb-4 border-b border-slate-100">
                                <span class="text-slate-500">Saturday - Wednesday</span>
                                <span class="text-slate-900">8:00 AM - 4:00 PM</span>
                            </li>
                            <li class="flex justify-between items-center pb-4 border-b border-slate-100">
                                <span class="text-slate-500">Thursday</span>
                                <span class="text-slate-900">8:00 AM - 1:00 PM</span>
                            </li>
                            <li class="flex justify-between items-center text-rose-500">
                                <span>Friday</span>
                                <span>Closed</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection