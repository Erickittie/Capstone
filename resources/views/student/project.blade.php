    ```blade
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


                {{-- =================================================
                    PM ONLY: CREATE TASK BUTTON
                ================================================== --}}

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
            ERROR MESSAGE
        ========================================================== --}}

        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 rounded-xl px-5 py-4">

                {{ session('error') }}

            </div>

        @endif


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}

        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 rounded-xl px-5 py-4">

                <ul class="list-disc list-inside text-sm">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

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
            MY ASSIGNED TASKS
        ========================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm p-6">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between
                        gap-3 mb-6">

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        My Assigned Tasks
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Tasks assigned to you within {{ $group->name }}
                    </p>

                </div>

                <span class="text-sm text-gray-500">

                    {{ $myTasks->count() }}

                    {{ $myTasks->count() === 1 ? 'task' : 'tasks' }}

                </span>

            </div>


            {{-- =====================================================
                TASK LIST
            ====================================================== --}}

            @forelse($myTasks as $task)

                @php

                    $assignment = $task->assignments->first();

                    $assignmentStatus =
                        $assignment?->status ?? 'Assigned';

                @endphp


                <div class="border border-gray-200
                            rounded-xl p-5 mb-4
                            hover:border-purple-200
                            hover:shadow-sm
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

                    <div class="flex flex-wrap gap-4 mt-5 text-sm">


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


                        {{-- ASSIGNMENT STATUS --}}

                        <div>

                            @if($assignmentStatus === 'Assigned')

                                <span class="px-3 py-1 rounded-full
                                            bg-yellow-100
                                            text-yellow-700">

                                    Assigned

                                </span>

                            @elseif($assignmentStatus === 'In Progress')

                                <span class="px-3 py-1 rounded-full
                                            bg-blue-100
                                            text-blue-700">

                                    In Progress

                                </span>

                            @elseif($assignmentStatus === 'Submitted')

                                <span class="px-3 py-1 rounded-full
                                            bg-green-100
                                            text-green-700">

                                    Submitted

                                </span>

                            @elseif($assignmentStatus === 'Approved')

                                <span class="px-3 py-1 rounded-full
                                            bg-emerald-100
                                            text-emerald-700">

                                    Approved

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full
                                            bg-gray-100
                                            text-gray-600">

                                    {{ $assignmentStatus }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- TASK ACTIONS --}}

                    <div class="mt-5 pt-4
                                border-t border-gray-100
                                flex flex-wrap gap-3">


                        {{-- VIEW TASK --}}

                        <a href="{{ route('student.tasks.show', [
                            'classId' => $class->id,
                            'projectId' => $project->id,
                            'taskId' => $task->id
                        ]) }}"
                        class="inline-flex items-center
                                justify-center gap-2
                                px-5 py-2.5
                                rounded-xl
                                bg-purple-600
                                text-white
                                font-semibold
                                hover:bg-purple-700
                                transition">

                            View Task

                        </a>


                        {{-- PM CAN REVIEW THEIR OWN SUBMISSION --}}

                        @if($isLeader && $assignmentStatus === 'Submitted')

                            <a href="{{ route('student.tasks.review', [
                                'classId' => $class->id,
                                'projectId' => $project->id,
                                'taskId' => $task->id
                            ]) }}"
                            class="inline-flex items-center
                                    justify-center gap-2
                                    px-5 py-2.5
                                    rounded-xl
                                    bg-amber-500
                                    text-white
                                    font-semibold
                                    hover:bg-amber-600
                                    transition">

                                Review Submission

                            </a>

                        @endif

                    </div>

                </div>

            @empty

                <div class="text-center py-12">

                    <div class="w-14 h-14 mx-auto
                                flex items-center justify-center
                                rounded-full bg-gray-100
                                text-gray-400 text-2xl">

                        ✓

                    </div>


                    <h3 class="font-semibold text-gray-700 mt-4">
                        No Tasks Assigned
                    </h3>


                    @if($isLeader)

                        <p class="text-sm text-gray-500 mt-1">
                            You haven't assigned any tasks to yourself yet.
                        </p>

                    @else

                        <p class="text-sm text-gray-500 mt-1">
                            Your Group Leader / PM has not assigned
                            any tasks to you yet.
                        </p>

                    @endif

                </div>

            @endforelse

        </div>


        {{-- =========================================================
            PM ONLY: TEAM TASK SUBMISSIONS
        ========================================================== --}}

        @if($isLeader)

            @php

                /*
                * Get all tasks belonging to this project
                * and this PM's group.
                *
                * This allows the PM to see submissions from
                * ALL members of the group, including themselves.
                */

                $teamTasks = $project->tasks()
                    ->where('group_id', $group->id)
                    ->with([
                        'assignments.student',
                        'submissions.student'
                    ])
                    ->get();

            @endphp


            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm p-6 mt-6">


                {{-- TEAM SUBMISSION HEADER --}}

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between
                            gap-3 mb-6">

                    <div>

                        <h2 class="text-xl font-bold text-gray-800">
                            Team Task Submissions
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Review submitted tasks from your group.
                        </p>

                    </div>


                    <span class="px-3 py-1 rounded-full
                                bg-amber-100 text-amber-700
                                text-sm font-semibold">

                        PM Review

                    </span>

                </div>


                {{-- =================================================
                    TEAM TASKS
                ================================================== --}}

                @php
                    $hasSubmissions = false;
                @endphp


                @foreach($teamTasks as $teamTask)

                    @php

                        $submittedAssignments = $teamTask->assignments
                            ->where('status', 'Submitted');

                    @endphp


                    @if($submittedAssignments->count() > 0)

                        @php
                            $hasSubmissions = true;
                        @endphp


                        <div class="border border-gray-200
                                    rounded-xl p-5 mb-4">


                            {{-- TASK HEADER --}}

                            <div class="flex flex-col md:flex-row
                                        md:items-start
                                        md:justify-between
                                        gap-4">

                                <div>

                                    <h3 class="font-bold text-lg
                                            text-gray-800">

                                        {{ $teamTask->title }}

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        {{ $submittedAssignments->count() }}

                                        {{ $submittedAssignments->count() === 1
                                            ? 'student submission'
                                            : 'student submissions' }}

                                    </p>

                                </div>


                                <span class="px-3 py-1
                                            rounded-full
                                            bg-green-100
                                            text-green-700
                                            text-sm font-semibold">

                                    Submitted

                                </span>

                            </div>


                            {{-- SUBMITTED STUDENTS --}}

                            <div class="mt-5 space-y-3">

                                @foreach($submittedAssignments as $submittedAssignment)

                                    <div class="flex flex-col md:flex-row
                                                md:items-center
                                                md:justify-between
                                                gap-4
                                                bg-gray-50
                                                rounded-xl
                                                p-4">


                                        <div>

                                            <div class="flex items-center
                                                        gap-2">

                                                <p class="font-semibold
                                                        text-gray-800">

                                                    {{ $submittedAssignment->student->name }}

                                                </p>


                                                {{-- IDENTIFY PM --}}

                                                @if(
                                                    $submittedAssignment->student_id
                                                    == auth()->id()
                                                )

                                                    <span class="px-2 py-0.5
                                                                rounded-full
                                                                bg-purple-100
                                                                text-purple-700
                                                                text-xs
                                                                font-semibold">

                                                        You / PM

                                                    </span>

                                                @endif

                                            </div>


                                            <p class="text-sm text-gray-500 mt-1">

                                                Task:
                                                {{ $teamTask->title }}

                                            </p>


                                            {{-- SUBMISSION INFO --}}

                                            @php

                                                $submission =
                                                    $teamTask->submissions
                                                    ->where(
                                                        'student_id',
                                                        $submittedAssignment->student_id
                                                    )
                                                    ->sortByDesc('submitted_at')
                                                    ->first();

                                            @endphp


                                            @if($submission)

                                                <p class="text-xs text-gray-400 mt-1">

                                                    Submitted:

                                                    {{ $submission->submitted_at
                                                        ? $submission->submitted_at->format('M d, Y h:i A')
                                                        : 'Recently' }}

                                                </p>

                                            @endif

                                        </div>


                                        {{-- REVIEW BUTTON --}}

                                        <a href="{{ route('student.tasks.review', [
                                            'classId' => $class->id,
                                            'projectId' => $project->id,
                                            'taskId' => $teamTask->id
                                        ]) }}"
                                        class="inline-flex items-center
                                                justify-center
                                                gap-2
                                                px-5 py-2.5
                                                rounded-xl
                                                bg-amber-500
                                                text-white
                                                font-semibold
                                                hover:bg-amber-600
                                                transition
                                                whitespace-nowrap">

                                            Review Submission

                                        </a>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif

                @endforeach


                {{-- =================================================
                    NO SUBMISSIONS
                ================================================== --}}

                @if(!$hasSubmissions)

                    <div class="text-center py-12
                                bg-gray-50
                                rounded-xl">

                        <div class="w-14 h-14 mx-auto
                                    flex items-center justify-center
                                    rounded-full
                                    bg-white
                                    border border-gray-200
                                    text-gray-400
                                    text-2xl">

                            📋

                        </div>


                        <h3 class="font-semibold text-gray-700 mt-4">

                            No Team Submissions Yet

                        </h3>


                        <p class="text-sm text-gray-500 mt-1">

                            Submitted tasks from your group
                            will appear here.

                        </p>

                    </div>

                @endif

            </div>

        @endif

    </div>

    @endsection
    ```
