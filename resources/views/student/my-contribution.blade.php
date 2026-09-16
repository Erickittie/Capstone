```blade
@extends('layouts.student')

@section('title', 'My Contribution Score')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <a href="{{ route('student.class.detail', $class->id) }}"
           class="inline-flex items-center text-sm
                  text-gray-500 hover:text-purple-600 mb-4">
            ← Back to Class
        </a>

        <div class="bg-white border border-gray-200
                    rounded-2xl shadow-sm p-6">

            <p class="text-sm font-semibold text-purple-600">
                {{ $class->course_code }}
            </p>

            <h1 class="text-3xl font-bold text-gray-800 mt-1">
                My Contribution Score
            </h1>

            <p class="text-gray-500 mt-2">
                {{ $class->course_name }}
            </p>

        </div>

    </div>


    {{-- No Group --}}
    @if(!$group)

        <div class="bg-white border border-gray-200
                    rounded-2xl p-10 text-center">

            <div class="text-5xl mb-4">
                👥
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                No Group Assigned
            </h2>

            <p class="text-gray-500 mt-2">
                You have not been assigned to a group for this class yet.
            </p>

        </div>

    @else

        {{-- Group Information --}}
        <div class="bg-white border border-gray-200
                    rounded-2xl shadow-sm p-6 mb-6">

            <p class="text-sm text-gray-500">
                Your Group
            </p>

            <h2 class="text-2xl font-bold text-gray-800 mt-1">
                {{ $group->name }}
            </h2>

        </div>


        {{-- Main Contribution --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- Contribution Score --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl shadow-sm p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            My Contribution
                        </p>

                        <h2 class="text-5xl font-bold
                                   text-purple-600 mt-2">

                            {{ number_format($contributionPercentage, 1) }}%

                        </h2>

                    </div>

                    <div class="text-5xl">
                        🎯
                    </div>

                </div>

                <p class="text-sm text-gray-500 mt-4">
                    Based on your approved task contribution
                    compared with the total approved group points.
                </p>

            </div>


            {{-- Progress --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl shadow-sm p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            My Task Progress
                        </p>

                        <h2 class="text-5xl font-bold
                                   text-blue-600 mt-2">

                            {{ number_format($progressPercentage, 1) }}%

                        </h2>

                    </div>

                    <div class="text-5xl">
                        📈
                    </div>

                </div>

                <div class="mt-5">

                    <div class="w-full bg-gray-200 rounded-full h-3">

                        <div
                            class="bg-blue-600 h-3 rounded-full"
                            style="width: {{ min($progressPercentage, 100) }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Statistics --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            {{-- Assigned --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl p-5">

                <p class="text-sm text-gray-500">
                    Assigned Tasks
                </p>

                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $assignedTasks }}
                </p>

            </div>


            {{-- Completed --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl p-5">

                <p class="text-sm text-gray-500">
                    Completed
                </p>

                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $completedTasks }}
                </p>

            </div>


            {{-- Submitted --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl p-5">

                <p class="text-sm text-gray-500">
                    Submitted
                </p>

                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $submittedTasks }}
                </p>

            </div>


            {{-- Pending --}}
            <div class="bg-white border border-gray-200
                        rounded-2xl p-5">

                <p class="text-sm text-gray-500">
                    Pending
                </p>

                <p class="text-3xl font-bold text-orange-500 mt-2">
                    {{ $pendingTasks }}
                </p>

            </div>

        </div>


        {{-- Points --}}
        <div class="bg-white border border-gray-200
                    rounded-2xl shadow-sm p-6 mt-6">

            <h2 class="text-xl font-bold text-gray-800">
                Contribution Points
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-6 mt-5">

                <div class="bg-purple-50 rounded-xl p-5">

                    <p class="text-sm text-purple-600">
                        My Approved Points
                    </p>

                    <p class="text-3xl font-bold text-purple-700 mt-2">
                        {{ number_format($myPoints, 1) }}
                    </p>

                </div>


                <div class="bg-gray-50 rounded-xl p-5">

                    <p class="text-sm text-gray-600">
                        Total Group Approved Points
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ number_format($groupPoints, 1) }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Link to Group Contribution --}}
        <div class="mt-6">

            <a href="{{ route('student.contribution', $class->id) }}"
               class="inline-flex items-center
                      px-5 py-3
                      bg-purple-600 text-white
                      rounded-xl font-semibold
                      hover:bg-purple-700 transition">

                View Group Contribution & Progress →

            </a>

        </div>

    @endif

</div>

@endsection
```
