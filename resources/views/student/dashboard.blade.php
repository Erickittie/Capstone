@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')

@php
    $gradients = [
        ['from' => 'from-[#0f766e]', 'to' => 'to-[#14b8a6]', 'icon' => 'dns'],
        ['from' => 'from-[#0369a1]', 'to' => 'to-[#0284c7]', 'icon' => 'school'],
        ['from' => 'from-[#6b21a8]', 'to' => 'to-[#9333ea]', 'icon' => 'psychology'],
        ['from' => 'from-[#c2410c]', 'to' => 'to-[#f59e0b]', 'icon' => 'palette'],
        ['from' => 'from-[#b91c1c]', 'to' => 'to-[#ef4444]', 'icon' => 'biotech'],
        ['from' => 'from-[#0d9488]', 'to' => 'to-[#06b6d4]', 'icon' => 'architecture'],
    ];
@endphp

<div class="space-y-6">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Welcome back, {{ $student->name }}
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Here are your enrolled classes and project activities.
        </p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-blue-600 text-[22px]">menu_book</span>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Enrolled Classes</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $classes->count() }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-purple-600 text-[22px]">account_tree</span>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Active Projects</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">0</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-amber-600 text-[22px]">assignment_late</span>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Pending Tasks</p>
                <p class="text-2xl font-bold text-gray-900 mt-0.5">0</p>
            </div>
        </div>

    </div>

    <!-- My Classes -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-base font-bold text-gray-900">My Classes</h2>
                <p class="text-sm text-gray-500 mt-0.5">Classes where you are currently enrolled.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

            @forelse($classes as $index => $class)
                @php
                    $theme = $gradients[$index % count($gradients)];
                @endphp

                <a href="{{ route('student.class.detail', $class->id) }}"
                   class="group block bg-white rounded-2xl border border-gray-200/80 shadow-xs hover:shadow-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden cursor-pointer">

                    <!-- Gradient Header -->
                    <div class="h-28 bg-gradient-to-r {{ $theme['from'] }} {{ $theme['to'] }} p-4 relative flex flex-col justify-between">
                        <div class="flex justify-end">
                            <div class="w-8 h-8 rounded-full bg-black/20 backdrop-blur-xs flex items-center justify-center text-white/90">
                                <span class="material-symbols-outlined text-[18px]">{{ $theme['icon'] }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-black/20 backdrop-blur-xs flex items-center justify-center text-white/90">
                                <span class="material-symbols-outlined text-[14px]">school</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex flex-col justify-between min-h-[120px]">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                                {{ $class->course_code }} · Sec {{ $class->section }}
                            </p>
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mt-1">
                                {{ $class->course_name }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $class->instructor->name ?? 'N/A' }}
                            </p>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between text-gray-400">
                            <p class="text-xs text-gray-400">{{ $class->semester }} {{ $class->academic_year }}</p>
                            <span class="text-xs font-semibold text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                Open →
                            </span>
                        </div>
                    </div>
                </a>

            @empty
                <div class="col-span-full bg-white border border-dashed border-gray-300 rounded-2xl p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-[32px]">menu_book</span>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">No Classes Yet</h2>
                    <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                        You will see your classes here once your instructor imports your student information.
                    </p>
                </div>
            @endforelse

        </div>
    </div>

</div>

@endsection