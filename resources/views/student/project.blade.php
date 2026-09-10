@extends('layouts.student')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="mb-8">

        <a href="{{ route('student.class.detail', $class->id) }}"
           class="text-sm text-purple-600 hover:text-purple-700">
            ← Back to Class
        </a>

        <div class="flex flex-col md:flex-row md:items-start
                    md:justify-between gap-4 mt-4">

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $project->title }}
                </h1>

                <p class="text-gray-500 mt-1">
                    {{ $class->course_code }} -
                    {{ $class->course_name }}
                </p>

            </div>


            {{-- PM ONLY: CREATE TASK BUTTON --}}

            @if($isLeader)

                <a href="{{ route('student.tasks.create', [
                    'classId' => $class->id,
                    'projectId' => $project->id
                ]) }}"
                   class="inline-flex items-center justify-center
                          gap-2 px-5 py-3
                          bg-purple-600 text-white
                          rounded-xl font-semibold
                          hover:bg-purple-700
                          transition shadow-sm">

                    <span class="text-lg">+</span>

                    Create Task

                </a>

            @endif

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-6 bg-green-50 border border-green-200
                    text-green-700 rounded-xl px-5 py-4">

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
         PROJECT INFORMATION
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-gray-200
                shadow-sm p-6 mb-6">

        <h2 class="text-xl font-bold text-gray-800 mb-3">
            Project Information
        </h2>


        @if($project->description)

            <p class="text-gray-600 leading-relaxed">
                {{ $project->description }}
            </p>

        @else

            <p class="text-gray-400 italic">
                No project description provided.
            </p>

        @endif


        <div class="grid grid-cols-1 md:grid-cols-3
                    gap-6 mt-6">


            {{-- START DATE --}}

            <div class="bg-gray-50 rounded-xl p-4">

                <p class="text-sm text-gray-500">
                    Start Date
                </p>

                <p class="font-semibold text-gray-800 mt-1">

                    {{ $project->start_date?->format('M d, Y') ?? 'Not set' }}

                </p>

            </div>


            {{-- END DATE --}}

            <div class="bg-gray-50 rounded-xl p-4">

                <p class="text-sm text-gray-500">
                    End Date
                </p>

                <p class="font-semibold text-gray-800 mt-1">

                    {{ $project->end_date?->format('M d, Y') ?? 'Not set' }}

                </p>

            </div>


            {{-- STATUS --}}

            <div class="bg-gray-50 rounded-xl p-4">

                <p class="text-sm text-gray-500">
                    Status
                </p>

                <span class="inline-flex mt-1 px-3 py-1
                             rounded-full text-sm font-medium
                             bg-green-100 text-green-700">

                    {{ $project->status }}

                </span>

            </div>

        </div>

    </div>


    {{-- =========================================================
         GROUP INFORMATION
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-gray-200
                shadow-sm p-6 mb-6">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Your Group
                </h2>

                <p class="text-gray-500 mt-1">
                    {{ $group->name }}
                </p>

            </div>


            {{-- PM LABEL --}}

            @if($isLeader)

                <span class="px-3 py-1 rounded-full
                             bg-purple-100 text-purple-700
                             text-sm font-semibold">

                    Group Leader / PM

                </span>

            @endif

        </div>


        {{-- MEMBERS --}}

        <div class="flex flex-wrap gap-2 mt-5">

            @foreach($group->students as $member)

                <span class="px-3 py-2 rounded-full
                             bg-gray-100 text-gray-700 text-sm">

                    {{ $member->name }}

                    @if($member->pivot->is_leader)

                        <span class="font-semibold text-purple-600">
                            (PM)
                        </span>

                    @endif

                </span>

            @endforeach

        </div>

    </div>


    {{-- =========================================================
         PROJECT TASKS
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-gray-200
                shadow-sm p-6">

        {{-- TASK HEADER --}}

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between
                    gap-3 mb-6">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Project Tasks
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Tasks assigned to your group
                </p>

            </div>


            {{-- TASK COUNT --}}

            <span class="text-sm text-gray-500">

                {{ $project->tasks->where('group_id', $group->id)->count() }}
                {{ Str::plural('task', $project->tasks->where('group_id', $group->id)->count()) }}

            </span>

        </div>


        {{-- =====================================================
             TASK LIST
        ====================================================== --}}

        @forelse($project->tasks->where('group_id', $group->id) as $task)

            <div class="border border-gray-200
                        rounded-xl p-5 mb-4
                        hover:border-purple-200
                        transition">


                {{-- TASK HEADER --}}

                <div class="flex flex-col md:flex-row
                            md:items-start md:justify-between
                            gap-4">

                    <div>

                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $task->title }}
                        </h3>


                        @if($task->description)

                            <p class="text-sm text-gray-500 mt-2">
                                {{ $task->description }}
                            </p>

                        @else

                            <p class="text-sm text-gray-400 italic mt-2">
                                No description provided.
                            </p>

                        @endif

                    </div>


                    {{-- POINTS --}}

                    <span class="self-start px-3 py-1
                                 rounded-full
                                 bg-purple-100
                                 text-purple-700
                                 text-sm font-semibold
                                 whitespace-nowrap">

                        {{ $task->points }} pts

                    </span>

                </div>


                {{-- TASK DETAILS --}}

                <div class="flex flex-wrap gap-4
                            mt-5 text-sm">


                    {{-- DUE DATE --}}

                    @if($task->due_date)

                        <div class="flex items-center gap-2
                                    text-gray-500">

                            <span>
                                Due:
                            </span>

                            <span class="font-semibold text-gray-700">

                                {{ $task->due_date->format('M d, Y') }}

                            </span>

                        </div>

                    @else

                        <div class="text-gray-400">
                            No deadline
                        </div>

                    @endif


                    {{-- STATUS --}}

                    <div>

                        <span class="px-3 py-1 rounded-full
                                     bg-gray-100
                                     text-gray-600">

                            {{ $task->status }}

                        </span>

                    </div>

                </div>


                {{-- =================================================
                     ASSIGNED MEMBERS
                ================================================== --}}

                <div class="mt-5 pt-4
                            border-t border-gray-100">

                    <p class="text-sm font-semibold text-gray-700 mb-3">

                        Assigned To

                    </p>


                    @if($task->assignments->count())

                        <div class="flex flex-wrap gap-2">

                            @foreach($task->assignments as $assignment)

                                @if($assignment->student)

                                    <span class="inline-flex
                                                 items-center
                                                 px-3 py-2
                                                 rounded-lg
                                                 bg-purple-50
                                                 text-purple-700
                                                 text-sm">

                                        {{ $assignment->student->name }}

                                    </span>

                                @endif

                            @endforeach

                        </div>

                    @else

                        <p class="text-sm text-gray-400">
                            No members assigned.
                        </p>

                    @endif

                </div>

            </div>

        @empty


            {{-- =================================================
                 NO TASKS
            ================================================== --}}

            <div class="text-center py-12">

                <div class="w-14 h-14 mx-auto
                            flex items-center justify-center
                            rounded-full bg-gray-100
                            text-gray-400 text-2xl">

                    ✓

                </div>


                <h3 class="font-semibold text-gray-700 mt-4">
                    No Tasks Yet
                </h3>


                @if($isLeader)

                    <p class="text-sm text-gray-500 mt-1">
                        Start by creating a task for your group.
                    </p>


                    <a href="{{ route('student.tasks.create', [
                        'classId' => $class->id,
                        'projectId' => $project->id
                    ]) }}"
                       class="inline-flex items-center gap-2
                              mt-5 px-5 py-3
                              bg-purple-600 text-white
                              rounded-xl font-semibold
                              hover:bg-purple-700 transition">

                        + Create First Task

                    </a>

                @else

                    <p class="text-sm text-gray-500 mt-1">
                        Your Group Leader / PM has not created
                        any tasks yet.
                    </p>

                @endif

            </div>

        @endforelse

    </div>

</div>

@endsection