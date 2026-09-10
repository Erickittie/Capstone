@extends('layouts.student')

@section('title', $class->course_code)

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- =========================================================
         CLASS HEADER
    ========================================================== --}}
    <div class="bg-white rounded-2xl border border-gray-200
                shadow-sm p-6 mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            {{ $class->course_code }}
        </h1>

        <p class="text-lg text-gray-600 mt-1">
            {{ $class->course_name }}
        </p>

        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2
                    text-sm text-gray-500">

            <span>
                Section: {{ $class->section }}
            </span>

            <span>
                Semester: {{ $class->semester }}
            </span>

            <span>
                Academic Year: {{ $class->academic_year }}
            </span>

        </div>

    </div>


    {{-- =========================================================
         MY PROJECTS
    ========================================================== --}}
    <div class="mb-10">

        <div class="flex items-center justify-between mb-4">

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    My Projects
                </h2>

                <p class="text-gray-500 mt-1">
                    Projects assigned to your group.
                </p>
            </div>

        </div>


        @if(isset($projects) && $projects->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach($projects as $project)

                    <a href="{{ route('student.project.show', [
                        'classId' => $class->id,
                        'projectId' => $project->id
                    ]) }}"
                       class="block bg-white border border-gray-200
                              rounded-2xl p-6 shadow-sm
                              hover:shadow-md hover:border-purple-300
                              hover:bg-purple-50/30
                              transition">

                        {{-- Project Header --}}
                        <div class="flex items-start
                                    justify-between gap-4">

                            <div>

                                <h3 class="text-xl font-bold
                                           text-gray-800">

                                    {{ $project->title }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    {{ $project->description
                                        ?: 'No project description available.' }}

                                </p>

                            </div>


                            {{-- Status --}}
                            <span class="shrink-0 px-3 py-1
                                         rounded-full text-xs
                                         font-semibold
                                         {{ strtolower($project->status) === 'active'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-gray-100 text-gray-600' }}">

                                {{ $project->status }}

                            </span>

                        </div>


                        {{-- Project Dates --}}
                        <div class="mt-5 grid grid-cols-2 gap-4">

                            <div>
                                <p class="text-xs text-gray-400">
                                    Start Date
                                </p>

                                <p class="text-sm font-semibold
                                          text-gray-700 mt-1">

                                    {{ $project->start_date
                                        ? $project->start_date->format('M d, Y')
                                        : 'Not set' }}

                                </p>
                            </div>


                            <div>
                                <p class="text-xs text-gray-400">
                                    End Date
                                </p>

                                <p class="text-sm font-semibold
                                          text-gray-700 mt-1">

                                    {{ $project->end_date
                                        ? $project->end_date->format('M d, Y')
                                        : 'Not set' }}

                                </p>
                            </div>

                        </div>


                        {{-- Open Project --}}
                        <div class="mt-5 pt-4
                                    border-t border-gray-100
                                    flex items-center
                                    justify-between">

                            <span class="text-sm text-gray-500">
                                Your group project
                            </span>

                            <span class="text-sm font-semibold
                                         text-purple-600">

                                Open Project →

                            </span>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            {{-- No Projects --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl p-8 text-center">

                <div class="text-4xl mb-3">
                    📋
                </div>

                <h3 class="text-lg font-bold text-gray-800">
                    No Projects Yet
                </h3>

                <p class="text-gray-500 mt-1">
                    Your instructor has not assigned a project
                    to your group yet.
                </p>

            </div>

        @endif

    </div>


    {{-- =========================================================
         CLASS ACTIVITIES
    ========================================================== --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        Class Activities
    </h2>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


        {{-- =====================================================
             GROUP STATUS
        ====================================================== --}}
        <a href="{{ route('student.group.status', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                👥
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                Group Status
            </h3>

            <p class="text-gray-500 mt-2">
                View your group members and current group leader.
            </p>

        </a>


        {{-- =====================================================
             LEADER VOTING
        ====================================================== --}}
        <a href="{{ route('student.vote.index', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                🗳️
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                Leader Voting
            </h3>

            <p class="text-gray-500 mt-2">
                Vote for a member of your group to become leader.
            </p>

        </a>


        {{-- =====================================================
             CONTRIBUTION
        ====================================================== --}}
        <a href="{{ route('student.contribution', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                📊
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                My Contribution
            </h3>

            <p class="text-gray-500 mt-2">
                View your contribution percentage and progress.
            </p>

        </a>


        {{-- =====================================================
             MY TASKS
        ====================================================== --}}
        <a href="{{ route('student.task.manager', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                ✅
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                My Tasks
            </h3>

            <p class="text-gray-500 mt-2">
                View and work on your assigned tasks.
            </p>

        </a>


        {{-- =====================================================
             FILE REPOSITORY
        ====================================================== --}}
        <a href="{{ route('student.file.repository', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                📁
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                File Repository
            </h3>

            <p class="text-gray-500 mt-2">
                Access your group's shared project files.
            </p>

        </a>


        {{-- =====================================================
             CHECK-IN
        ====================================================== --}}
        <a href="{{ route('student.checkin.index', $class->id) }}"
           class="bg-white border border-gray-200
                  rounded-2xl p-6
                  hover:shadow-md hover:border-purple-300
                  transition">

            <div class="text-3xl mb-4">
                📝
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                Check-in Request
            </h3>

            <p class="text-gray-500 mt-2">
                Submit or view your class check-in request.
            </p>

        </a>

    </div>

</div>

@endsection