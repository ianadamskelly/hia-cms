@extends('layouts.app')

@section('title', 'Academic Calendar 2025-2026')

@push('styles')
<style>
    /* Custom Scrollbar */
    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    [x-cloak] { display: none !important; }

    @media print {
        .no-print { display: none !important; }
        .print-only { display: block !important; }
        body { background-color: white; }
    }
</style>
@endpush

@section('content')
<div x-data="calendarApp" x-cloak class="max-w-7xl mx-auto p-4 md:p-8 min-h-screen flex flex-col gap-6">

    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">HIA School Calendar</h1>
            <p class="text-gray-500 mt-1">Academic Year 2025 - 2026</p>
        </div>
        <div class="flex gap-3 no-print">
            <div class="relative">
                <input x-model="searchQuery" type="text" placeholder="Search events..."
                    class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-64 text-sm font-medium">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <button onclick="window.print()"
                class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Print
            </button>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Calendar View -->
        <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <!-- Month Navigation -->
            <div class="flex justify-between items-center mb-6">
                <button @click="prevMonth()" class="p-2 hover:bg-gray-100 rounded-full transition-colors no-print">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-gray-800"
                    x-text="monthNames[currentDate.getMonth()] + ' ' + currentDate.getFullYear()"></h2>
                <button @click="nextMonth()" class="p-2 hover:bg-gray-100 rounded-full transition-colors no-print">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Days Header -->
            <div class="grid grid-cols-7 mb-2 text-center">
                <template x-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider py-2" x-text="day"></div>
                </template>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-1 lg:gap-2">
                <template x-for="day in daysInMonth" :key="day.dateStr">
                    <div @click="selectDate(day.dateStr)" :class="{
                            'bg-blue-50': isToday(day.dateStr),
                            'bg-gray-50 opacity-50': day.isPadding,
                            'hover:bg-blue-50 cursor-pointer': !day.isPadding,
                            'ring-2 ring-blue-500 ring-inset': selectedDate === day.dateStr
                        }"
                        class="min-h-[80px] md:min-h-[100px] border border-gray-100 rounded-lg p-2 flex flex-col transition-all relative">

                        <span
                            :class="{'text-blue-600 font-bold': isToday(day.dateStr), 'text-gray-400': day.isPadding, 'text-gray-700': !day.isPadding && !isToday(day.dateStr)}"
                            class="text-sm font-medium mb-1" x-text="day.dayNumber">
                        </span>

                        <div class="flex flex-col gap-1 overflow-hidden font-medium">
                            <template x-for="event in getEventsForDate(day.dateStr)">
                                <div :class="getEventColor(event.type)"
                                    class="text-[10px] px-1.5 py-0.5 rounded truncate font-medium leading-tight">
                                    <span x-text="event.title"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Side Panel -->
        <div class="w-full lg:w-96 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-[600px] lg:h-auto">
            <div class="p-5 border-b border-gray-100 bg-gray-50 rounded-t-2xl">
                <h3 class="font-bold text-gray-800">Events</h3>
                <p class="text-sm text-gray-500" x-text="selectedDate ? formatDate(selectedDate) : 'Select a date'"></p>
            </div>

            <div class="flex-1 overflow-y-auto p-4 custom-scroll">
                <!-- If Searching -->
                <template x-if="searchQuery.length > 0">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase mb-3 font-medium">Search Results</p>
                        <template x-for="event in searchResults">
                            <div class="mb-3 p-3 rounded-xl border border-gray-100 bg-white shadow-sm hover:shadow-md transition-shadow font-medium">
                                <div class="flex items-center gap-2 mb-1">
                                    <span :class="getEventDot(event.type)" class="w-2 h-2 rounded-full"></span>
                                    <span class="text-xs font-semibold text-gray-500" x-text="formatDateShort(event.date)"></span>
                                </div>
                                <p class="text-sm font-medium text-gray-800" x-text="event.title"></p>
                            </div>
                        </template>
                        <div x-show="searchResults.length === 0" class="text-center py-8 text-gray-400 text-sm">No events found.</div>
                    </div>
                </template>

                <!-- Standard List -->
                <template x-if="searchQuery.length === 0">
                    <div>
                        <template x-if="selectedDateEvents.length > 0">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase mb-3 font-medium">Selected Date</p>
                                <template x-for="event in selectedDateEvents">
                                    <div class="mb-3 p-4 rounded-xl border border-blue-100 bg-blue-50/30 shadow-sm border-l-4 border-l-blue-500 font-medium">
                                        <p class="text-sm font-bold text-gray-900" x-text="event.title"></p>
                                        <p class="text-xs text-blue-600 mt-1 font-semibold uppercase tracking-wider" x-text="event.category"></p>
                                    </div>
                                </template>
                            </div>
                        </template>

                        <p class="text-xs font-bold text-gray-400 uppercase mb-3 mt-4" x-text="monthNames[currentDate.getMonth()] + ' Upcoming'"></p>
                        <template x-for="event in currentMonthEvents">
                            <div class="mb-3 p-3 rounded-xl border border-gray-100 bg-white shadow-sm flex gap-3 items-start font-medium">
                                <div class="flex flex-col items-center min-w-[3rem] bg-gray-50 rounded-lg p-1 border border-gray-200">
                                    <span class="text-[10px] uppercase font-bold text-gray-500" x-text="getShortMonth(event.date)"></span>
                                    <span class="text-lg font-bold text-gray-800" x-text="getDayNum(event.date)"></span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800 leading-snug" x-text="event.title"></p>
                                    <span :class="getEventBadge(event.type)" class="inline-block mt-1 text-[10px] px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wide">
                                        <span x-text="event.type"></span>
                                    </span>
                                </div>
                            </div>
                        </template>
                        <div x-show="currentMonthEvents.length === 0 && selectedDateEvents.length === 0" class="text-center py-10 font-medium">
                            <p class="text-gray-400 text-sm">No events scheduled for this period.</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="flex flex-wrap gap-4 justify-center text-xs text-gray-600 border-t border-gray-200 pt-6 font-medium">
        <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-blue-100 border border-blue-200"></span> Academic</div>
        <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-red-100 border border-red-200"></span> Holiday</div>
        <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-purple-100 border border-purple-200"></span> Exam</div>
        <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-100 border border-green-200"></span> Event</div>
        <div class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-amber-100 border border-amber-200"></span> Staff/PD</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('calendarApp', () => ({
            currentDate: new Date(),
            selectedDate: null,
            searchQuery: '',
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            events: @json($events),

            get daysInMonth() {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                let days = [];
                for (let i = 0; i < firstDay; i++) {
                    days.push({ dayNumber: '', dateStr: `padding-${i}`, isPadding: true });
                }
                for (let i = 1; i <= daysInMonth; i++) {
                    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                    days.push({ dayNumber: i, dateStr: dateStr, isPadding: false });
                }
                return days;
            },

            get currentMonthEvents() {
                return this.events.filter(e => {
                    const d = new Date(e.date);
                    return d.getMonth() === this.currentDate.getMonth() &&
                           d.getFullYear() === this.currentDate.getFullYear();
                }).sort((a, b) => new Date(a.date) - new Date(b.date));
            },

            get selectedDateEvents() {
                if (!this.selectedDate) return [];
                return this.events.filter(e => e.date === this.selectedDate);
            },

            get searchResults() {
                if (this.searchQuery.trim() === '') return [];
                const query = this.searchQuery.toLowerCase();
                return this.events.filter(e =>
                    e.title.toLowerCase().includes(query) || e.date.includes(query)
                ).sort((a, b) => new Date(a.date) - new Date(b.date));
            },

            prevMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
                this.selectedDate = null;
            },
            nextMonth() {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
                this.selectedDate = null;
            },
            selectDate(dateStr) {
                if (!dateStr || dateStr.startsWith('padding')) return;
                this.selectedDate = dateStr;
            },
            isToday(dateStr) {
                const today = new Date();
                const d = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
                return dateStr === d;
            },
            getEventsForDate(dateStr) {
                if (!dateStr || dateStr.startsWith('padding')) return [];
                return this.events.filter(e => e.date === dateStr);
            },
            getEventColor(type) {
                const colors = {
                    'academic': 'bg-blue-100 text-blue-700',
                    'holiday': 'bg-red-100 text-red-700',
                    'exam': 'bg-purple-100 text-purple-700',
                    'event': 'bg-green-100 text-green-700',
                    'staff': 'bg-amber-100 text-amber-800'
                };
                return colors[type] || 'bg-gray-100 text-gray-700';
            },
            getEventBadge(type) {
                const colors = {
                    'academic': 'bg-blue-100 text-blue-600',
                    'holiday': 'bg-red-100 text-red-600',
                    'exam': 'bg-purple-100 text-purple-600',
                    'event': 'bg-green-100 text-green-600',
                    'staff': 'bg-amber-100 text-amber-600'
                };
                return colors[type] || 'bg-gray-100 text-gray-600';
            },
            getEventDot(type) {
                const colors = {
                    'academic': 'bg-blue-500',
                    'holiday': 'bg-red-500',
                    'exam': 'bg-purple-500',
                    'event': 'bg-green-500',
                    'staff': 'bg-amber-500'
                };
                return colors[type] || 'bg-gray-500';
            },
            formatDate(dateStr) {
                if (!dateStr || dateStr.startsWith('padding')) return '';
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateStr).toLocaleDateString('en-US', options);
            },
            formatDateShort(dateStr) {
                const options = { month: 'short', day: 'numeric' };
                return new Date(dateStr).toLocaleDateString('en-US', options);
            },
            getShortMonth(dateStr) {
                return new Date(dateStr).toLocaleDateString('en-US', { month: 'short' });
            },
            getDayNum(dateStr) {
                return new Date(dateStr).getDate();
            }
        }));
    });
</script>
@endpush
