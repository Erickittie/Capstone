@extends('layouts.instructor')

@section('content')

@php
    $gradients = [
        ['from' => 'from-[#0f766e]', 'to' => 'to-[#14b8a6]', 'icons' => ['description', 'groups']],
        ['from' => 'from-[#0d9488]', 'to' => 'to-[#06b6d4]', 'icons' => ['architecture', 'build']],
        ['from' => 'from-[#0369a1]', 'to' => 'to-[#0284c7]', 'icons' => ['school', 'smart_display']],
        ['from' => 'from-[#6b21a8]', 'to' => 'to-[#9333ea]', 'icons' => ['security', 'account_tree']],
        ['from' => 'from-[#c2410c]', 'to' => 'to-[#f59e0b]', 'icons' => ['directions_run', 'view_kanban']],
        ['from' => 'from-[#b91c1c]', 'to' => 'to-[#ef4444]', 'icons' => ['accessibility_new', 'handyman']],
    ];
@endphp

<div class="space-y-6">

    <!-- Top Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                My Classrooms
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Access your assigned course sections, manage groups, and track project tasks.
            </p>
        </div>
    </div>

    <!-- Class Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($classes as $index => $class)
            @php
                $theme = $gradients[$index % count($gradients)];
            @endphp

            <a href="{{ route('instructor.class.configure', $class->id) }}"
               class="group block bg-white rounded-2xl border border-gray-200/80 shadow-xs hover:shadow-lg hover:-translate-y-1 transition-all duration-200 overflow-hidden cursor-pointer">

                <!-- Gradient Header with Badges & Kebab -->
                <div class="h-36 bg-gradient-to-r {{ $theme['from'] }} {{ $theme['to'] }} p-4 relative flex flex-col justify-between">

                    <!-- Top Action (Kebab) -->
                    <div class="flex justify-end">
                        <button type="button" class="text-white/80 hover:text-white p-1 rounded-full hover:bg-white/10 transition" onclick="event.preventDefault();">
                            <span class="material-symbols-outlined text-[20px]">
                                more_vert
                            </span>
                        </button>
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
                        <h2 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1">
                            {{ $class->course_name }}
                        </h2>

                        <p class="text-xs text-gray-500 font-medium mt-1">
                            {{ $class->course_code }} • Sec {{ $class->section }}
                        </p>

                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $class->semester }} {{ $class->academic_year }}
                        </p>
                    </div>

                    <!-- Card Footer Icon -->
                    <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-gray-400">
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
            <div class="col-span-full bg-white border border-dashed border-gray-300 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-[32px]">
                        school
                    </span>
                </div>
                <h2 class="text-lg font-bold text-gray-900">
                    No Classes Assigned
                </h2>
                <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                    Classes assigned to your account by the administrator will appear here.
                </p>
            </div>
        @endforelse

    </div>

</div>

@endsection