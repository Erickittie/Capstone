@extends('layouts.instructor')

@section('title', 'Archived Classrooms')

@section('content')

@php
    $gradients = [
        ['from' => 'from-[#475569]', 'to' => 'to-[#64748b]', 'icons' => ['inventory_2', 'history']],
        ['from' => 'from-[#334155]', 'to' => 'to-[#475569]', 'icons' => ['archive', 'source']],
        ['from' => 'from-[#1e293b]', 'to' => 'to-[#334155]', 'icons' => ['folder_zip', 'analytics']],
        ['from' => 'from-[#0f172a]', 'to' => 'to-[#1e293b]', 'icons' => ['bookmarks', 'folder_special']],
    ];
@endphp

<div class="space-y-6">

    <!-- Flash Notification -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 flex items-center justify-between shadow-xs animate-fadeIn">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600 text-[22px]">check_circle</span>
                <p class="text-sm font-semibold">{{ session('success') }}</p>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 transition">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
    @endif

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('instructor.dashboard') }}" class="text-xs font-semibold text-gray-500 hover:text-gray-900 inline-flex items-center gap-1 transition">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    Dashboard
                </a>
                <span class="text-gray-300">/</span>
                <span class="text-xs font-semibold text-gray-700">Archive</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 flex items-center gap-2.5">
                <span>Archived Classrooms</span>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-300">
                    {{ $archivedClasses->count() }} {{ Str::plural('course', $archivedClasses->count()) }}
                </span>
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Stored courses from previous school years/semesters and manually archived classrooms.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <div class="px-3.5 py-2 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-xs font-medium flex items-center gap-2 shadow-xs">
                <span class="material-symbols-outlined text-blue-600 text-[18px]">calendar_month</span>
                <span>Active Term: <strong>{{ $currentSemester }}, {{ $currentAcademicYear }}</strong></span>
            </div>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white rounded-2xl border border-slate-300 p-4.5 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <!-- Search Input -->
        <form method="GET" action="{{ route('instructor.archive') }}" class="flex-1 flex items-center gap-3">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">
                    search
                </span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by course code, title, or offer code..."
                    class="w-full h-10 pl-10 pr-4 text-sm rounded-xl border border-slate-300 bg-slate-50/60 hover:border-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 text-slate-900 placeholder-slate-400 shadow-2xs outline-none transition"
                >
            </div>

            @if(request('academic_year'))
                <input type="hidden" name="academic_year" value="{{ request('academic_year') }}">
            @endif

            <button
                type="submit"
                class="px-4 h-10 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold shadow-xs transition">
                Search
            </button>

            @if(request('search') || request('academic_year'))
                <a href="{{ route('instructor.archive') }}" class="h-10 px-3.5 rounded-xl border border-slate-300 hover:border-slate-400 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold inline-flex items-center gap-1 shadow-2xs transition">
                    <span class="material-symbols-outlined text-[16px]">clear</span>
                    Reset
                </a>
            @endif
        </form>

        <!-- Academic Year Dropdown Filter -->
        <div class="flex items-center gap-2">
            <label for="year-select" class="text-xs font-semibold text-slate-600 whitespace-nowrap">
                School Year:
            </label>
            <select
                id="year-select"
                onchange="location.href = this.value;"
                class="h-10 px-3.5 pr-8 text-xs font-semibold rounded-xl border border-slate-300 bg-slate-50/60 hover:border-slate-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 text-slate-900 shadow-2xs outline-none transition">
                <option value="{{ route('instructor.archive', array_merge(request()->query(), ['academic_year' => 'all'])) }}" {{ !$selectedYear || $selectedYear === 'all' ? 'selected' : '' }}>
                    All School Years
                </option>
                @foreach($academicYears as $year)
                    <option
                        value="{{ route('instructor.archive', array_merge(request()->query(), ['academic_year' => $year])) }}"
                        {{ $selectedYear === $year ? 'selected' : '' }}>
                        S.Y. {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- Archived Class Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($archivedClasses as $index => $class)
            @php
                $theme = $gradients[$index % count($gradients)];
                $isExpired = $class->isPastPeriod($currentAcademicYear, $currentSemester);
            @endphp

            <a href="{{ route('instructor.class.configure', $class->id) }}"
               class="group block bg-white rounded-2xl border-2 border-slate-300 hover:border-slate-500 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden cursor-pointer">

                <!-- Gradient Header with Badges & Kebab -->
                <div class="h-36 bg-gradient-to-r {{ $theme['from'] }} {{ $theme['to'] }} p-4 relative flex flex-col justify-between">

                    <!-- Top Action (Header Tag & Kebab) -->
                    <div class="flex justify-between items-center">
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-black/40 backdrop-blur-xs text-white/95 border border-white/20">
                            Archived
                        </span>

                        <span class="text-white/80 hover:text-white p-1 rounded-full hover:bg-white/10 transition">
                            <span class="material-symbols-outlined text-[20px]">
                                more_vert
                            </span>
                        </span>
                    </div>

                    <!-- Bottom Icon Badges -->
                    <div class="flex items-center gap-2">
                        @foreach($theme['icons'] as $iconName)
                            <div class="w-8 h-8 rounded-full bg-black/20 backdrop-blur-xs flex items-center justify-center text-white/90 shadow-xs">
                                <span class="material-symbols-outlined text-[16px]">
                                    {{ $iconName }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5 flex flex-col justify-between min-h-[140px]">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-1">
                            {{ $class->course_name }}
                        </h2>

                        <p class="text-xs text-slate-600 font-semibold mt-1">
                            {{ $class->course_code }} • Sec {{ $class->offer_code ?? $class->section }}
                        </p>

                        <p class="text-xs text-slate-500 mt-0.5 font-medium">
                            {{ $class->semester }} {{ $class->academic_year }}
                        </p>
                    </div>

                    <!-- Card Footer Icon -->
                    <div class="mt-4 pt-3 border-t border-slate-300 flex items-center justify-between text-slate-400">
                        <span class="material-symbols-outlined text-[18px]">
                            assignment
                        </span>
                        <span class="text-xs font-semibold text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                            Configure &rarr;
                        </span>
                    </div>
                </div>
            </a>

        @empty
            <div class="col-span-full bg-white border-2 border-dashed border-slate-400/90 rounded-2xl p-12 text-center shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-600 border border-slate-300 flex items-center justify-center mx-auto mb-4 shadow-xs">
                    <span class="material-symbols-outlined text-[32px]">
                        inventory_2
                    </span>
                </div>
                <h2 class="text-lg font-bold text-slate-900">
                    No Archived Classrooms Found
                </h2>
                <p class="text-sm text-slate-500 mt-1 max-w-md mx-auto">
                    @if(request('search') || request('academic_year'))
                        No archived courses match your current search or school year filter. Try clearing the filter.
                    @else
                        Courses that have concluded or belong to past school years (e.g. {{ $currentAcademicYear }}) will be stored here automatically or when archived.
                    @endif
                </p>
                @if(request('search') || request('academic_year'))
                    <div class="mt-6 flex items-center justify-center gap-3">
                        <a href="{{ route('instructor.archive') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-semibold hover:bg-black shadow-xs transition">
                            Clear Filters
                        </a>
                    </div>
                @endif
            </div>
        @endforelse

    </div>

</div>

@endsection
