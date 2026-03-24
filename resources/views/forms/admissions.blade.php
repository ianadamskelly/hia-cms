@extends('layouts.app')

@section('title', 'Admissions Inquiry')
@section('meta_description', 'Submit an admissions inquiry.')

@section('content')
    <section class="bg-blue-50 border-b">
        <div class="max-w-5xl mx-auto px-4 py-16">
            <h1 class="text-4xl font-bold text-gray-900">Admissions Inquiry</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                Tell us about your interest and our admissions team will get in touch with you.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 py-12">
        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admissions.submit') }}" method="POST"
            class="space-y-6 bg-white border rounded-2xl p-8 shadow-sm">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Parent Name</label>
                    <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                        class="w-full rounded-lg border px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Student Name</label>
                    <input type="text" name="student_name" value="{{ old('student_name') }}"
                        class="w-full rounded-lg border px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-lg border px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Programme of Interest</label>
                    <select name="programme_interest" class="w-full rounded-lg border px-4 py-3">
                        <option value="">Select programme</option>
                        @foreach($programmes as $programme)
                            <option value="{{ $programme->name }}" @selected(old('programme_interest') === $programme->name)>
                                {{ $programme->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Campus of Interest</label>
                    <select name="campus_interest" class="w-full rounded-lg border px-4 py-3">
                        <option value="">Select campus</option>
                        @foreach($campuses as $campus)
                            <option value="{{ $campus->name }}" @selected(old('campus_interest') === $campus->name)>
                                {{ $campus->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Message</label>
                <textarea name="message" rows="6" class="w-full rounded-lg border px-4 py-3">{{ old('message') }}</textarea>
            </div>

            <div>
                <button type="submit" class="rounded-lg bg-blue-700 px-6 py-3 text-white font-semibold hover:bg-blue-800">
                    Submit Inquiry
                </button>
            </div>
        </form>
    </section>
@endsection