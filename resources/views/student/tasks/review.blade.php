@extends('layouts.student')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-8">

```
{{-- Back to Task --}}
<div class="mb-6">
    <a
        href="{{ route('student.tasks.show', [
            'classId' => $class->id,
            'projectId' => $project->id,
            'taskId' => $task->id
        ]) }}"
        class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition"
    >
        ← Back to Task
    </a>
</div>


{{-- Success --}}
@if(session('success'))
    <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700">
        {{ session('success') }}
    </div>
@endif


{{-- Error --}}
@if(session('error'))
    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-700">
        {{ session('error') }}
    </div>
@endif


{{-- Validation Errors --}}
@if($errors->any())
    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-5 py-4 text-red-700">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Page Header --}}
<div class="mb-8">

    <p class="text-sm text-gray-500 mb-2">
        {{ $project->title }}
    </p>

    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Review Submissions
            </h1>

            <p class="text-gray-600 mt-2">
                {{ $task->title }}
            </p>

            <p class="text-sm text-gray-500 mt-1">
                {{ $group->name }}
                · {{ $task->points }} points
            </p>

        </div>

        <div class="px-4 py-2 rounded-xl bg-purple-100 text-purple-700 font-semibold">
            Group Leader / PM
        </div>

    </div>

</div>


{{-- Task Information --}}
<div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8">

    <h2 class="text-lg font-semibold text-gray-900 mb-3">
        Task Information
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">
                Task
            </p>

            <p class="font-semibold text-gray-900 mt-1">
                {{ $task->title }}
            </p>
        </div>


        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">
                Points
            </p>

            <p class="font-semibold text-gray-900 mt-1">
                {{ $task->points }}
            </p>
        </div>


        <div class="bg-gray-50 rounded-xl p-4">
            <p class="text-xs text-gray-500">
                Due Date
            </p>

            <p class="font-semibold text-gray-900 mt-1">

                @if($task->due_date)
                    {{ $task->due_date->format('M d, Y') }}
                @else
                    No due date
                @endif

            </p>
        </div>

    </div>

</div>


{{-- Submissions --}}
<div class="space-y-6">

    @forelse($submissions as $submission)

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- Submission Header --}}
            <div class="p-6 border-b border-gray-200">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600">
                            {{ strtoupper(substr($submission->student->name ?? 'S', 0, 1)) }}
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-gray-900">
                                {{ $submission->student->name ?? 'Unknown Student' }}
                            </h2>

                            @if($submission->student->student_id)
                                <p class="text-sm text-gray-500">
                                    Student ID: {{ $submission->student->student_id }}
                                </p>
                            @endif

                        </div>

                    </div>


                    {{-- Status --}}
                    @if($submission->status === 'Pending')

                        <span class="inline-flex w-fit px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                            Pending Review
                        </span>

                    @elseif($submission->status === 'Approved')

                        <span class="inline-flex w-fit px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                            Approved
                        </span>

                    @elseif($submission->status === 'Rejected')

                        <span class="inline-flex w-fit px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                            Rejected
                        </span>

                    @else

                        <span class="inline-flex w-fit px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-700">
                            {{ $submission->status }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- Submission Content --}}
            <div class="p-6">

                {{-- Submitted Date --}}
                <div class="mb-6">

                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        Submitted
                    </p>

                    <p class="text-sm text-gray-700 mt-1">

                        @if($submission->submitted_at)
                            {{ $submission->submitted_at->format('M d, Y h:i A') }}
                        @else
                            N/A
                        @endif

                    </p>

                </div>


                {{-- Written Submission --}}
                @if($submission->submission_text)

                    <div class="mb-6">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Work Description
                        </p>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">

                            <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                                {{ $submission->submission_text }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- SUBMITTED FILE --}}
                {{-- ================================================= --}}
                <div class="mb-6">

                    <p class="text-sm font-semibold text-gray-700 mb-2">
                        Submitted File
                    </p>

                    @if($submission->file_path)

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-blue-50 border border-blue-200 rounded-xl p-5">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-lg bg-blue-600 text-white flex items-center justify-center text-xl">
                                    📎
                                </div>

                                <div>

                                    <p class="font-semibold text-gray-900">
                                        {{ basename($submission->file_path) }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Submitted attachment
                                    </p>

                                </div>

                            </div>


                            <a
                                href="{{ asset('storage/' . $submission->file_path) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
                            >
                                View File
                                ↗
                            </a>

                        </div>

                    @else

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">

                            <p class="text-sm text-gray-500">
                                No file was attached to this submission.
                            </p>

                        </div>

                    @endif

                </div>


                {{-- Existing Feedback --}}
                @if($submission->feedback)

                    <div class="mb-6">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            Feedback
                        </p>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">

                            <p class="text-sm text-gray-700 whitespace-pre-line">
                                {{ $submission->feedback }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- ================================================= --}}
                {{-- PENDING REVIEW --}}
                {{-- ================================================= --}}
                @if($submission->status === 'Pending')

                    <div class="border-t border-gray-200 pt-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            {{-- APPROVE --}}
                            <div class="border border-green-200 bg-green-50 rounded-xl p-5">

                                <h3 class="font-semibold text-green-800 mb-2">
                                    Approve Submission
                                </h3>

                                <p class="text-sm text-green-700 mb-4">
                                    Approving this submission will mark the assigned task as completed.
                                </p>


                                <form
                                    method="POST"
                                    action="{{ route('student.tasks.approve', [
                                        'classId' => $class->id,
                                        'projectId' => $project->id,
                                        'taskId' => $task->id,
                                        'submissionId' => $submission->id
                                    ]) }}"
                                >

                                    @csrf

                                    <label
                                        for="approve_feedback_{{ $submission->id }}"
                                        class="block text-sm font-semibold text-gray-700 mb-2"
                                    >
                                        Feedback
                                    </label>

                                    <textarea
                                        id="approve_feedback_{{ $submission->id }}"
                                        name="feedback"
                                        rows="3"
                                        placeholder="Optional feedback..."
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                    ></textarea>


                                    <button
                                        type="submit"
                                        class="mt-4 w-full px-5 py-3 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 transition"
                                    >
                                        ✓ Approve Submission
                                    </button>

                                </form>

                            </div>


                            {{-- REJECT --}}
                            <div class="border border-red-200 bg-red-50 rounded-xl p-5">

                                <h3 class="font-semibold text-red-800 mb-2">
                                    Reject Submission
                                </h3>

                                <p class="text-sm text-red-700 mb-4">
                                    The student will be able to work on the task again after rejection.
                                </p>


                                <form
                                    method="POST"
                                    action="{{ route('student.tasks.reject', [
                                        'classId' => $class->id,
                                        'projectId' => $project->id,
                                        'taskId' => $task->id,
                                        'submissionId' => $submission->id
                                    ]) }}"
                                >

                                    @csrf

                                    <label
                                        for="reject_feedback_{{ $submission->id }}"
                                        class="block text-sm font-semibold text-gray-700 mb-2"
                                    >
                                        Reason / Feedback
                                    </label>

                                    <textarea
                                        id="reject_feedback_{{ $submission->id }}"
                                        name="feedback"
                                        rows="3"
                                        required
                                        placeholder="Explain what needs to be improved..."
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    ></textarea>


                                    <button
                                        type="submit"
                                        class="mt-4 w-full px-5 py-3 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition"
                                    >
                                        ✕ Reject Submission
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Approved --}}
                @if($submission->status === 'Approved')

                    <div class="border-t border-green-200 pt-5">

                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">

                            <p class="font-semibold text-green-800">
                                ✓ Submission Approved
                            </p>

                            @if($submission->approved_at)

                                <p class="text-sm text-green-700 mt-1">
                                    Approved:
                                    {{ $submission->approved_at->format('M d, Y h:i A') }}
                                </p>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- Rejected --}}
                @if($submission->status === 'Rejected')

                    <div class="border-t border-red-200 pt-5">

                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">

                            <p class="font-semibold text-red-800">
                                ✕ Submission Rejected
                            </p>

                            <p class="text-sm text-red-700 mt-1">
                                The student must revise and resubmit the task.
                            </p>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">

            <div class="text-4xl mb-4">
                📭
            </div>

            <h2 class="text-lg font-semibold text-gray-900">
                No Submissions Yet
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                No students have submitted work for this task yet.
            </p>

        </div>

    @endforelse

</div>
```

</div>

@endsection
