@extends('layouts.app')

@section('title', 'Page Not Found')
@section('meta_description', 'The page you are looking for could not be found.')
@section('meta_robots', 'noindex,nofollow')

@section('content')
    <section class="max-w-4xl mx-auto px-4 py-24 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-700">404 Error</p>
        <h1 class="mt-4 text-5xl font-bold text-gray-900">Page not found</h1>
        <p class="mt-6 text-lg text-gray-600">
            The page you are looking for does not exist, may have been moved, or the link may be incorrect.
        </p>

        <div class="mt-10 flex justify-center gap-4 flex-wrap">
            <a href="{{ url('/') }}" class="rounded-lg bg-blue-700 px-6 py-3 text-white font-semibold hover:bg-blue-800">
                Go Home
            </a>
            <a href="{{ route('contact.form') }}"
                class="rounded-lg border border-blue-700 px-6 py-3 text-blue-700 font-semibold hover:bg-blue-50">
                Contact Us
            </a>
        </div>
    </section>
@endsection