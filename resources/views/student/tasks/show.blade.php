@extends('layouts.student')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-8">

```
{{-- Back to Project --}}
<div class="mb-6">
    <a
        href="{{ route('student.project.show', [
            'classId' => $class->id,
            'projectId' => $project->id
        ]) }}"
        class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition"
    >
        ← Back to Project
    </a>
</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>
@endif


{{-- Error Message --}}
@if(session('error'))
    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">
        {{ session('error') }}
    </div>
@endif


{{-- Validation Errors --}}
@if($errors->any())
    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Task Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}
    <div class="p-8 border-b border-gray-200">

        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

            <div>

                <p class="text-sm text-gray-500 mb-2">
                    {{ $project->title }}
                </p>

                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $task->title }}
                </h1>

                <p class="mt-2 text-gray-500">
                    {{ $group->name }}
                </p>

            </div>


            {{-- Status Badge --}}
            @php
                $status = $assignment->status ?? 'Assigned';
            @endphp

            <span
                class="inline-flex w-fit px-3 py-1 rounded-full text-sm font-medium
                @if($status === 'Assigned')
                    bg-gray-100 text-gray-700
                @elseif($status === 'In Progress')
                    bg-blue-100 text-blue-700
                @elseif($status === 'Submitted')
                    bg-yellow-100 text-yellow-700
                @elseif($status === 'Approved')
                    bg-green-100 text-green-700
                @else
                    bg-gray-100 text-gray-700
                @endif"
            >
                {{ $status }}
            </span>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- TASK INFORMATION --}}
    {{-- ================================================= --}}
    <div class="p-8">


        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

            {{-- Points --}}
            <div class="bg-gray-50 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Task Points
                </p>

                <p class="text-2xl font-bold text-gray-900 mt-1">
                    {{ $task->points }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    Contribution points
                </p>

            </div>


            {{-- Due Date --}}
            <div class="bg-gray-50 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Due Date
                </p>

                <p class="text-lg font-semibold text-gray-900 mt-1">

                    @if($task->due_date)

                        {{ $task->due_date->format('M d, Y') }}

                    @else

                        No due date

                    @endif

                </p>

            </div>


            {{-- Assigned Student --}}
            <div class="bg-gray-50 rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Assigned To
                </p>

                <p class="text-lg font-semibold text-gray-900 mt-1">
                    {{ $student->name }}
                </p>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TASK DESCRIPTION --}}
        {{-- ================================================= --}}
        <div class="mb-8">

            <h2 class="text-lg font-semibold text-gray-900 mb-3">
                Task Description
            </h2>

            @if($task->description)

                <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed">
                    {!! nl2br(e($task->description)) !!}
                </div>

            @else

                <div class="bg-gray-50 rounded-xl p-5 text-gray-500">
                    No description provided.
                </div>

            @endif

        </div>


        {{-- ================================================= --}}
        {{-- ASSIGNMENT DETAILS --}}
        {{-- ================================================= --}}
        <div class="mb-8">

            <h2 class="text-lg font-semibold text-gray-900 mb-3">
                Assignment Details
            </h2>

            <div class="border border-gray-200 rounded-xl divide-y">

                {{-- Status --}}
                <div class="flex justify-between items-center px-5 py-4">

                    <span class="text-gray-500">
                        Status
                    </span>

                    <span class="font-medium text-gray-900">
                        {{ $assignment->status }}
                    </span>

                </div>


                {{-- Started --}}
                <div class="flex justify-between items-center px-5 py-4">

                    <span class="text-gray-500">
                        Started
                    </span>

                    <span class="font-medium text-gray-900">

                        @if($assignment->started_at)

                            {{ $assignment->started_at->format('M d, Y h:i A') }}

                        @else

                            Not started

                        @endif

                    </span>

                </div>


                {{-- Completed --}}
                <div class="flex justify-between items-center px-5 py-4">

                    <span class="text-gray-500">
                        Completed
                    </span>

                    <span class="font-medium text-gray-900">

                        @if($assignment->completed_at)

                            {{ $assignment->completed_at->format('M d, Y h:i A') }}

                        @else

                            Not completed

                        @endif

                    </span>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- GROUP LEADER / PM REVIEW --}}
        {{-- ================================================= --}}
        @if(isset($isLeader) && $isLeader)

            <div class="mb-8 border-2 border-purple-200 bg-purple-50 rounded-2xl p-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                    <div class="flex items-start gap-4">

                        <div class="w-11 h-11 rounded-xl bg-purple-600 text-white flex items-center justify-center text-lg">
                            ✓
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-purple-900">
                                Group Leader / Project Manager
                            </h2>

                            <p class="text-sm text-purple-700 mt-1">
                                You are the group leader. You can review submissions
                                from students assigned to this task.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('student.tasks.review', [
                            'classId' => $class->id,
                            'projectId' => $project->id,
                            'taskId' => $task->id
                        ]) }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-purple-600 text-white font-semibold hover:bg-purple-700 transition shadow-sm"
                    >
                        Review Submissions
                        →
                    </a>

                </div>

            </div>

        @endif


        {{-- ================================================= --}}
        {{-- ASSIGNED --}}
        {{-- ================================================= --}}
        @if($assignment->status === 'Assigned')

            <div class="border border-gray-200 rounded-2xl p-6 bg-gray-50">

                <div class="mb-5">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Ready to Start?
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Start this task when you are ready to begin working on it.
                    </p>

                </div>


                <div class="flex justify-end">

                    <form
                        method="POST"
                        action="{{ route('student.tasks.start', [
                            'classId' => $class->id,
                            'projectId' => $project->id,
                            'taskId' => $task->id
                        ]) }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 active:bg-blue-800 transition shadow-sm"
                        >
                            Start Task
                        </button>

                    </form>

                </div>

            </div>


        {{-- ================================================= --}}
        {{-- IN PROGRESS --}}
        {{-- ================================================= --}}
        @elseif($assignment->status === 'In Progress')

            <div class="border border-blue-200 bg-blue-50 rounded-2xl p-6">

                <div class="mb-6">

                    <h2 class="text-lg font-semibold text-blue-900">
                        Submit Task
                    </h2>

                    <p class="text-sm text-blue-700 mt-1">
                        Submit your completed work to the group leader for review.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('student.tasks.submit', [
                        'classId' => $class->id,
                        'projectId' => $project->id,
                        'taskId' => $task->id
                    ]) }}"
                    enctype="multipart/form-data"
                >

                    @csrf


                    {{-- Submission Description --}}
                    <div class="mb-6">

                        <label
                            for="submission_text"
                            class="block text-sm font-semibold text-gray-700 mb-2"
                        >
                            Your Work / Description
                        </label>

                        <textarea
                            id="submission_text"
                            name="submission_text"
                            rows="6"
                            placeholder="Describe what you completed, what you worked on, or any important notes for the group leader..."
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >{{ old('submission_text') }}</textarea>

                        <p class="text-xs text-gray-400 mt-2">
                            You may provide a written explanation of your work.
                        </p>

                    </div>


                    {{-- File Upload --}}
                    <div class="mb-6">

                        <label
                            for="file"
                            class="block text-sm font-semibold text-gray-700 mb-2"
                        >
                            Attach File
                        </label>

                        <input
                            type="file"
                            id="file"
                            name="file"
                            accept=".pdf,.doc,.docx,.txt,.zip,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-gray-600
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100"
                        >

                        <p class="text-xs text-gray-400 mt-2">
                            Accepted: PDF, DOC, DOCX, TXT, ZIP, JPG, JPEG, PNG.
                            Maximum file size: 10 MB.
                        </p>

                    </div>


                    {{-- Submit Actions --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3">

                        <a
                            href="{{ route('student.project.show', [
                                'classId' => $class->id,
                                'projectId' => $project->id
                            ]) }}"
                            class="px-6 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-50 transition text-center"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 active:bg-blue-800 transition shadow-sm"
                        >
                            Submit Task
                        </button>

                    </div>

                </form>

            </div>


        {{-- ================================================= --}}
        {{-- SUBMITTED --}}
        {{-- ================================================= --}}
        @elseif($assignment->status === 'Submitted')

            <div class="border border-yellow-200 bg-yellow-50 rounded-2xl p-6">

                <div class="flex items-start gap-4">

                    <div class="text-2xl">
                        ⏳
                    </div>

                    <div class="flex-1">

                        <h2 class="text-lg font-semibold text-yellow-800">
                            Task Submitted
                        </h2>

                        <p class="text-sm text-yellow-700 mt-1">
                            Your work has been submitted and is waiting for review by the group leader.
                        </p>


                        {{-- Latest Submission --}}
                        @php

                            $latestSubmission = $task->submissions()
                                ->where('student_id', $student->id)
                                ->latest('submitted_at')
                                ->first();

                        @endphp


                        @if($latestSubmission)

                            <div class="mt-5 bg-white border border-yellow-200 rounded-xl p-5">

                                <div class="flex flex-col gap-4">

                                    {{-- Submitted Date --}}
                                    <div>

                                        <p class="text-xs text-gray-500">
                                            Submitted
                                        </p>

                                        <p class="text-sm font-medium text-gray-800">
                                            @if($latestSubmission->submitted_at)
                                                {{ $latestSubmission->submitted_at->format('M d, Y h:i A') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>

                                    </div>


                                    {{-- Description --}}
                                    @if($latestSubmission->submission_text)

                                        <div>

                                            <p class="text-xs text-gray-500 mb-1">
                                                Description
                                            </p>

                                            <p class="text-sm text-gray-700 whitespace-pre-line">
                                                {{ $latestSubmission->submission_text }}
                                            </p>

                                        </div>

                                    @endif


                                    {{-- File --}}
                                    @if($latestSubmission->file_path)

                                        <div>

                                            <a
                                                href="{{ asset('storage/' . $latestSubmission->file_path) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800"
                                            >
                                                📎 View Submitted File
                                            </a>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


        {{-- ================================================= --}}
        {{-- APPROVED --}}
        {{-- ================================================= --}}
        @elseif($assignment->status === 'Approved')

            <div class="border border-green-200 bg-green-50 rounded-2xl p-6">

                <div class="flex items-start gap-4">

                    <div class="text-2xl">
                        ✓
                    </div>

                    <div>

                        <h2 class="text-lg font-semibold text-green-800">
                            Task Approved
                        </h2>

                        <p class="text-sm text-green-700 mt-1">
                            Your submitted work has been approved by the group leader.
                        </p>


                        @if($assignment->completed_at)

                            <p class="text-xs text-green-600 mt-2">
                                Completed:
                                {{ $assignment->completed_at->format('M d, Y h:i A') }}
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>
```

</div>

@endsection
