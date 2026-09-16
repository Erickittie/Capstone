@extends('layouts.student')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">
        <a href="{{ route('student.class.detail', $class->id) }}"
           class="inline-flex items-center gap-2 text-sm text-purple-600 hover:text-purple-700 font-medium">
            ← Back to Class
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Group Contribution & Progress
        </h1>

        <p class="text-gray-500 mt-2">
            View your group members' contribution percentages and task progress.
        </p>

        <div class="mt-4 flex flex-wrap items-center gap-3">

            <span class="px-3 py-1.5 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold">
                {{ $class->course_code }}
            </span>

            <span class="text-gray-500">
                {{ $class->course_name }}
            </span>

            <span class="text-gray-300">
                •
            </span>

            <span class="font-semibold text-gray-700">
                {{ $group->name }}
            </span>

        </div>
    </div>


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        {{-- Members --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Group Members
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $members->count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                    👥
                </div>

            </div>

        </div>


        {{-- Contribution Points --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Approved Points
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($totalContributionPoints, 1) }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                    ⭐
                </div>

            </div>

        </div>


        {{-- Group Progress --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Group Progress
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $groupProgress }}%
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                    📈
                </div>

            </div>

        </div>

    </div>


    {{-- Members --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">

        <div class="p-6 border-b border-gray-200">

            <h2 class="text-xl font-bold text-gray-800">
                Group Members
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Contribution and progress of each group member.
            </p>

        </div>


        <div class="p-6 space-y-5">

            @forelse($members as $member)

                @php
                    $initial = strtoupper(substr($member->name, 0, 1));
                @endphp

                <div class="border border-gray-200 rounded-2xl p-5 hover:border-purple-200 transition">

                    {{-- Member Header --}}
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg">
                                {{ $initial }}
                            </div>

                            <div>

                                <div class="flex items-center gap-2">

                                    <h3 class="font-bold text-gray-800">
                                        {{ $member->name }}
                                    </h3>

                                    @if($member->id == auth()->id())
                                        <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                            You
                                        </span>
                                    @endif

                                    @if($member->is_leader)
                                        <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-700 text-xs font-semibold">
                                            PM
                                        </span>
                                    @endif

                                </div>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $member->completed_tasks }}
                                    of
                                    {{ $member->assigned_tasks }}
                                    tasks completed
                                </p>

                            </div>

                        </div>


                        {{-- Contribution --}}
                        <div class="text-left md:text-right">

                            <p class="text-sm text-gray-500">
                                Contribution
                            </p>

                            <p class="text-2xl font-bold text-purple-600">
                                {{ $member->contribution_percentage }}%
                            </p>

                        </div>

                    </div>


                    {{-- Contribution Progress Bar --}}
                    <div class="mt-5">

                        <div class="flex items-center justify-between text-sm mb-2">

                            <span class="font-medium text-gray-600">
                                Contribution
                            </span>

                            <span class="font-semibold text-gray-700">
                                {{ $member->contribution_percentage }}%
                            </span>

                        </div>

                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">

                            <div
                                class="h-full bg-purple-600 rounded-full transition-all"
                                style="width: {{ min($member->contribution_percentage, 100) }}%"
                            ></div>

                        </div>

                    </div>


                    {{-- Task Progress --}}
                    <div class="mt-5">

                        <div class="flex items-center justify-between text-sm mb-2">

                            <span class="font-medium text-gray-600">
                                Task Progress
                            </span>

                            <span class="font-semibold text-gray-700">
                                {{ $member->progress }}%
                            </span>

                        </div>

                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">

                            <div
                                class="h-full bg-blue-600 rounded-full transition-all"
                                style="width: {{ min($member->progress, 100) }}%"
                            ></div>

                        </div>

                    </div>


                    {{-- Task Statistics --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-5">

                        <div class="bg-gray-50 rounded-xl p-3">

                            <p class="text-xs text-gray-500">
                                Assigned
                            </p>

                            <p class="font-bold text-gray-800 mt-1">
                                {{ $member->assigned_tasks }}
                            </p>

                        </div>


                        <div class="bg-green-50 rounded-xl p-3">

                            <p class="text-xs text-green-600">
                                Approved
                            </p>

                            <p class="font-bold text-green-700 mt-1">
                                {{ $member->completed_tasks }}
                            </p>

                        </div>


                        <div class="bg-yellow-50 rounded-xl p-3">

                            <p class="text-xs text-yellow-600">
                                Submitted
                            </p>

                            <p class="font-bold text-yellow-700 mt-1">
                                {{ $member->submitted_tasks }}
                            </p>

                        </div>


                        <div class="bg-blue-50 rounded-xl p-3">

                            <p class="text-xs text-blue-600">
                                In Progress
                            </p>

                            <p class="font-bold text-blue-700 mt-1">
                                {{ $member->in_progress_tasks }}
                            </p>

                        </div>

                    </div>


                    {{-- Points --}}
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">

                        <span class="text-sm text-gray-500">
                            Contribution Points
                        </span>

                        <span class="font-bold text-gray-800">
                            {{ number_format($member->contribution_points, 1) }} pts
                        </span>

                    </div>

                </div>

            @empty

                <div class="text-center py-12">

                    <div class="text-5xl mb-4">
                        👥
                    </div>

                    <h3 class="font-semibold text-gray-700">
                        No Group Members
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Your group does not have any members yet.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection