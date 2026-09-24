@extends('layouts.student')

@section('title', 'Task Manager')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Separate tasks by Kanban status
    |--------------------------------------------------------------------------
    */

    $pendingTasks = collect();
    $progressTasks = collect();
    $submittedTasks = collect();
    $approvedTasks = collect();
    $rejectedTasks = collect();

    foreach ($tasks as $task) {

        $assignment = $task->assignments->first();
        $submission = $task->submissions->first();

        if ($submission) {

            if ($submission->status === 'Approved') {
                $approvedTasks->push($task);
            }

            elseif ($submission->status === 'Rejected') {
                $rejectedTasks->push($task);
            }

            else {
                $submittedTasks->push($task);
            }

        }

        elseif ($assignment?->status === 'In Progress') {
            $progressTasks->push($task);
        }

        else {
            $pendingTasks->push($task);
        }
    }

    $kanbanColumns = [
        'pending' => [
            'title' => 'Pending',
            'description' => 'Waiting to be started',
            'tasks' => $pendingTasks,
        ],

        'progress' => [
            'title' => 'In Progress',
            'description' => 'Currently working',
            'tasks' => $progressTasks,
        ],

        'submitted' => [
            'title' => 'Submitted',
            'description' => 'Waiting for PM review',
            'tasks' => $submittedTasks,
        ],

        'approved' => [
            'title' => 'Approved',
            'description' => 'Successfully completed',
            'tasks' => $approvedTasks,
        ],
    ];
@endphp


<div class="space-y-6">

    {{-- ============================================================
         PAGE HEADER
    ============================================================ --}}

    <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-5">

        <div>

            <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">

                <span>
                    {{ $class->course_code }}
                </span>

                <span class="text-gray-300">•</span>

                <span>
                    {{ $group?->name ?? 'No Group' }}
                </span>

            </div>

            <h1 class="text-2xl font-bold text-gray-900 mt-2">
                Task Manager
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Track your assigned tasks and monitor their progress.
            </p>

        </div>


        {{-- TOTAL TASKS --}}

        <div class="flex items-center gap-3">

            <div class="px-4 py-3 bg-white border border-gray-200 rounded-xl">

                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                    Total Tasks
                </p>

                <p class="text-xl font-bold text-gray-900 mt-1">
                    {{ $tasks->count() }}
                </p>

            </div>

        </div>

    </div>



    {{-- ============================================================
         SUMMARY CARDS
    ============================================================ --}}

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- TOTAL --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-500">
                        Total Tasks
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $tasks->count() }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">

                    <span class="material-symbols-outlined text-gray-600">
                        assignment
                    </span>

                </div>

            </div>

        </div>


        {{-- IN PROGRESS --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-500">
                        In Progress
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $progressTasks->count() }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">

                    <span class="material-symbols-outlined text-blue-600">
                        pending
                    </span>

                </div>

            </div>

        </div>


        {{-- SUBMITTED --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-500">
                        Awaiting Review
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $submittedTasks->count() }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">

                    <span class="material-symbols-outlined text-amber-600">
                        rate_review
                    </span>

                </div>

            </div>

        </div>


        {{-- APPROVED --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-semibold text-gray-500">
                        Completed
                    </p>

                    <p class="text-2xl font-bold text-gray-900 mt-2">
                        {{ $approvedTasks->count() }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">

                    <span class="material-symbols-outlined text-green-600">
                        check_circle
                    </span>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
         NO GROUP
    ============================================================ --}}

    @if(!$group)

        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">

            <div class="w-14 h-14 mx-auto rounded-xl bg-gray-100 flex items-center justify-center">

                <span class="material-symbols-outlined text-3xl text-gray-400">
                    groups
                </span>

            </div>

            <h2 class="mt-5 text-lg font-bold text-gray-900">
                No group assigned
            </h2>

            <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
                You have not been assigned to a group for this class yet.
            </p>

        </div>

    @else


        {{-- ========================================================
             KANBAN HEADER
        ========================================================= --}}

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-gray-900">
                    My Tasks
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Follow your task progress from assignment to approval.
                </p>

            </div>

            <div class="text-xs text-gray-400">
                {{ $tasks->count() }}
                {{ Str::plural('task', $tasks->count()) }}
            </div>

        </div>



        {{-- ========================================================
             KANBAN BOARD
        ========================================================= --}}

        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-4 items-start">

            @foreach($kanbanColumns as $columnKey => $column)

                <div class="bg-gray-100/70 border border-gray-200 rounded-2xl p-3 min-h-[420px]">


                    {{-- COLUMN HEADER --}}

                    <div class="px-2 pt-1 pb-3">

                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                @if($columnKey === 'pending')

                                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>

                                @elseif($columnKey === 'progress')

                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                @elseif($columnKey === 'submitted')

                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                @else

                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                @endif

                                <h3 class="text-sm font-bold text-gray-900">
                                    {{ $column['title'] }}
                                </h3>

                            </div>


                            <span class="min-w-6 h-6 px-2 rounded-full bg-white border border-gray-200 flex items-center justify-center text-[11px] font-bold text-gray-600">

                                {{ $column['tasks']->count() }}

                            </span>

                        </div>

                        <p class="text-[11px] text-gray-500 mt-1">
                            {{ $column['description'] }}
                        </p>

                    </div>



                    {{-- TASK LIST --}}

                    <div class="space-y-3">

                        @forelse($column['tasks'] as $task)

                            @php

                                $assignment = $task->assignments->first();

                                $submission = $task->submissions->first();

                            @endphp


                            {{-- =================================================
                                 TASK CARD
                            ================================================== --}}

                            <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">


                                {{-- PROJECT --}}

                                @if($task->project)

                                    <div class="flex items-center justify-between gap-2">

                                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 truncate">

                                            {{ $task->project->title }}

                                        </p>

                                        @if($task->points)

                                            <span class="text-[10px] font-bold text-blue-600 whitespace-nowrap">

                                                {{ $task->points }} pts

                                            </span>

                                        @endif

                                    </div>

                                @endif



                                {{-- TASK TITLE --}}

                                <h4 class="text-sm font-bold text-gray-900 mt-2 leading-snug">

                                    {{ $task->title }}

                                </h4>



                                {{-- DESCRIPTION --}}

                                @if($task->description)

                                    <p class="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">

                                        {{ $task->description }}

                                    </p>

                                @endif



                                {{-- META --}}

                                <div class="flex items-center justify-between gap-3 mt-4 pt-3 border-t border-gray-100">

                                    @if($task->due_date)

                                        <div class="flex items-center gap-1.5 text-[11px] text-gray-500">

                                            <span class="material-symbols-outlined text-[15px]">
                                                calendar_today
                                            </span>

                                            {{ $task->due_date->format('M d') }}

                                        </div>

                                    @else

                                        <span class="text-[11px] text-gray-400">
                                            No due date
                                        </span>

                                    @endif


                                    @if($columnKey === 'pending')

                                        <span class="text-[10px] font-semibold text-gray-500">
                                            Not started
                                        </span>

                                    @elseif($columnKey === 'progress')

                                        <span class="text-[10px] font-semibold text-blue-600">
                                            In progress
                                        </span>

                                    @elseif($columnKey === 'submitted')

                                        <span class="text-[10px] font-semibold text-amber-600">
                                            PM review
                                        </span>

                                    @else

                                        <span class="text-[10px] font-semibold text-green-600">
                                            Completed
                                        </span>

                                    @endif

                                </div>



                                {{-- REJECTION FEEDBACK --}}

                                @if($submission?->status === 'Rejected' && $submission?->feedback)

                                    <div class="mt-3 p-3 rounded-lg bg-red-50 border border-red-100">

                                        <div class="flex items-center gap-1.5">

                                            <span class="material-symbols-outlined text-[15px] text-red-500">
                                                feedback
                                            </span>

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-red-600">
                                                PM Feedback
                                            </p>

                                        </div>

                                        <p class="text-xs text-red-700 mt-1.5 leading-relaxed">

                                            {{ $submission->feedback }}

                                        </p>

                                    </div>

                                @endif



                                {{-- ACTION --}}

                                <div class="mt-4">

                                    <a
                                        href="{{ route('student.tasks.show', [
                                            'classId' => $class->id,
                                            'projectId' => $task->project_id,
                                            'taskId' => $task->id,
                                        ]) }}"
                                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg bg-gray-900 text-white text-xs font-semibold hover:bg-gray-800 transition"
                                    >

                                        <span class="material-symbols-outlined text-[16px]">
                                            visibility
                                        </span>

                                        @if($columnKey === 'pending')

                                            View Task

                                        @elseif($columnKey === 'progress')

                                            Continue Task

                                        @elseif($columnKey === 'submitted')

                                            View Submission

                                        @else

                                            View Completed Task

                                        @endif

                                    </a>

                                </div>

                            </div>


                        @empty

                            {{-- EMPTY COLUMN --}}

                            <div class="border border-dashed border-gray-300 rounded-xl p-7 text-center bg-white/40">

                                <span class="material-symbols-outlined text-3xl text-gray-300">
                                    task_alt
                                </span>

                                <p class="text-xs text-gray-400 mt-2">
                                    No tasks here
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            @endforeach

        </div>



        {{-- ========================================================
             NEEDS REVISION
        ========================================================= --}}

        @if($rejectedTasks->count() > 0)

            <div class="mt-2">

                <div class="flex items-center justify-between mb-3">

                    <div>

                        <div class="flex items-center gap-2">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            <h2 class="text-sm font-bold text-gray-900">
                                Needs Revision
                            </h2>

                            <span class="px-2 py-0.5 rounded-full bg-red-50 text-red-600 text-[10px] font-bold">

                                {{ $rejectedTasks->count() }}

                            </span>

                        </div>

                        <p class="text-[11px] text-gray-500 mt-1">
                            These tasks were rejected by the project manager and need changes.
                        </p>

                    </div>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                    @foreach($rejectedTasks as $task)

                        @php
                            $submission = $task->submissions->first();
                        @endphp

                        <div class="bg-white border border-red-200 rounded-xl p-4 shadow-sm">


                            <div class="flex items-start justify-between gap-3">

                                <div>

                                    @if($task->project)

                                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                            {{ $task->project->title }}
                                        </p>

                                    @endif

                                    <h3 class="text-sm font-bold text-gray-900 mt-1">
                                        {{ $task->title }}
                                    </h3>

                                </div>


                                <span class="shrink-0 px-2 py-1 rounded-md bg-red-50 text-red-600 text-[10px] font-bold">
                                    Rejected
                                </span>

                            </div>


                            @if($submission?->feedback)

                                <div class="mt-3 bg-red-50 rounded-lg p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-red-500">
                                        PM Feedback
                                    </p>

                                    <p class="text-xs text-red-700 mt-1 leading-relaxed">
                                        {{ $submission->feedback }}
                                    </p>

                                </div>

                            @endif


                            <div class="mt-4">

                                <a
                                    href="{{ route('student.tasks.show', [
                                        'classId' => $class->id,
                                        'projectId' => $task->project_id,
                                        'taskId' => $task->id,
                                    ]) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg border border-gray-200 bg-white text-gray-700 text-xs font-semibold hover:bg-gray-50 transition"
                                >

                                    <span class="material-symbols-outlined text-[16px]">
                                        edit
                                    </span>

                                    Revise & Resubmit

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    @endif

</div>

@endsection