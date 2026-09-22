@extends('layouts.student')

@section('title', $class->course_code)

@section('content')

<div class="space-y-8">

    {{-- =========================================================
         CLASS HEADER
    ========================================================== --}}
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-6">

        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-1">
                    {{ $class->course_code }} · Section {{ $class->section }}
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                    {{ $class->course_name }}
                </h1>
                <div class="flex flex-wrap gap-x-5 gap-y-1 mt-3 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-gray-400">calendar_today</span>
                        {{ $class->semester }} {{ $class->academic_year }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-gray-400">person</span>
                        {{ $class->instructor->name ?? 'N/A' }}
                    </span>
                </div>
            </div>
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                Active
            </span>
        </div>

    </div>


    {{-- =========================================================
         MY PROJECTS
    ========================================================== --}}
    <div>

        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-base font-bold text-gray-900">My Projects</h2>
                <p class="text-sm text-gray-500 mt-0.5">Projects assigned to your group.</p>
            </div>
        </div>

        @if(isset($projects) && $projects->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                @foreach($projects as $project)

                    <a href="{{ route('student.project.show', [
                        'classId' => $class->id,
                        'projectId' => $project->id
                    ]) }}"
                       class="group block bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-purple-300 transition-all duration-150">

                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-purple-600 text-[20px]">account_tree</span>
                            </div>
                            <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold
                                {{ strtolower($project->status) === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-600' }}">
                                {{ $project->status }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                            {{ $project->title }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                            {{ $project->description ?: 'No project description available.' }}
                        </p>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div>
                                <p class="text-xs text-gray-400">Start Date</p>
                                <p class="text-sm font-semibold text-gray-700 mt-0.5">
                                    {{ $project->start_date ? $project->start_date->format('M d, Y') : 'Not set' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">End Date</p>
                                <p class="text-sm font-semibold text-gray-700 mt-0.5">
                                    {{ $project->end_date ? $project->end_date->format('M d, Y') : 'Not set' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400">Your group project</span>
                            <span class="text-xs font-semibold text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                Open Project →
                            </span>
                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="bg-white border border-dashed border-gray-300 rounded-2xl p-10 text-center">
                <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-[28px]">account_tree</span>
                </div>
                <h3 class="text-base font-bold text-gray-800">No Projects Yet</h3>
                <p class="text-sm text-gray-500 mt-1">Your instructor has not assigned a project to your group yet.</p>
            </div>

        @endif

    </div>


    {{-- =========================================================
         CLASS ACTIVITIES
    ========================================================== --}}
    <div>

        <div class="mb-4">
            <h2 class="text-base font-bold text-gray-900">Class Activities</h2>
            <p class="text-sm text-gray-500 mt-0.5">Quick access to all your class features.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            {{-- Group Status --}}
            <a href="{{ route('student.group.status', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-blue-600 text-[22px]">groups</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Group Status</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">View your group members and current group leader.</p>
            </a>

            {{-- Leader Voting --}}
            <a href="{{ route('student.vote.index', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-indigo-600 text-[22px]">how_to_vote</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Leader Voting</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">Vote for a member of your group to become leader.</p>
            </a>

            {{-- Group Contribution --}}
            <a href="{{ route('student.contribution', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">monitoring</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Group Contribution</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">View your group contribution percentage and progress.</p>
            </a>

            {{-- My Contribution --}}
            <a href="{{ route('student.my.contribution.class', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">monitoring</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">My Contribution</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">View your personal contribution score, points, and task progress.</p>
            </a>

            {{-- My Tasks --}}
            <a href="{{ route('student.task.manager', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-amber-600 text-[22px]">assignment</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-amber-600 transition-colors">My Tasks</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">View and work on your assigned tasks.</p>
            </a>

            {{-- File Repository --}}
            <a href="{{ route('student.file.repository', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-orange-600 text-[22px]">folder_open</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-orange-600 transition-colors">File Repository</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">Access your group's shared project files.</p>
            </a>

            {{-- Check-in Request --}}
            <a href="{{ route('student.checkin.index', $class->id) }}"
               class="group bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-150">
                <div class="w-11 h-11 rounded-xl bg-violet-50 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-violet-600 text-[22px]">event_available</span>
                </div>
                <h3 class="text-sm font-bold text-gray-900 group-hover:text-violet-600 transition-colors">Check-In Request</h3>
                <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">Submit or view your class check-in request.</p>
            </a>

        </div>

    </div>

</div>

@endsection