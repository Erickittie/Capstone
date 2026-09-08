@extends('layouts.instructor')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Projects
            </h1>

            <p class="text-gray-500 mt-1">
                Manage projects for {{ $class->course_code }}
                - {{ $class->section }}
            </p>
        </div>

        <a
            href="{{ route('instructor.projects.create', $class->id) }}"
            class="inline-flex items-center gap-2 px-5 py-3
                   bg-purple-600 text-white rounded-xl
                   font-semibold hover:bg-purple-700 transition"
        >
            <span class="text-lg">+</span>
            Create Project
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-6 p-4 rounded-xl bg-green-50
                    border border-green-200 text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="mb-6 p-4 rounded-xl bg-red-50
                    border border-red-200 text-red-700">

            {{ session('error') }}

        </div>

    @endif


    {{-- Projects --}}
    @if($projects->count())

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($projects as $project)

                <div class="bg-white rounded-2xl border border-gray-200
                            p-6 hover:shadow-lg transition">

                    {{-- Project Title --}}
                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h2 class="text-xl font-bold text-gray-900">
                                {{ $project->title }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $class->course_code }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($project->status === 'Active')
                                bg-green-100 text-green-700
                            @elseif($project->status === 'Completed')
                                bg-blue-100 text-blue-700
                            @else
                                bg-gray-100 text-gray-700
                            @endif"
                        >
                            {{ $project->status }}
                        </span>

                    </div>


                    {{-- Description --}}
                    <div class="mt-5">

                        @if($project->description)

                            <p class="text-sm text-gray-600 line-clamp-3">
                                {{ $project->description }}
                            </p>

                        @else

                            <p class="text-sm text-gray-400 italic">
                                No description provided.
                            </p>

                        @endif

                    </div>


                    {{-- Dates --}}
                    <div class="mt-6 space-y-2 text-sm">

                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                Start Date
                            </span>

                            <span class="font-medium text-gray-700">
                                {{ $project->start_date
                                    ? $project->start_date->format('M d, Y')
                                    : 'Not set'
                                }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-gray-500">
                                End Date
                            </span>

                            <span class="font-medium text-gray-700">
                                {{ $project->end_date
                                    ? $project->end_date->format('M d, Y')
                                    : 'Not set'
                                }}
                            </span>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="mt-6 pt-5 border-t border-gray-100
                                flex items-center gap-2">

                        <a
                            href="{{ route(
                                'instructor.projects.edit',
                                [
                                    'classId' => $class->id,
                                    'projectId' => $project->id
                                ]
                            ) }}"
                            class="flex-1 text-center px-4 py-2
                                   rounded-lg border border-gray-300
                                   text-gray-700 font-medium
                                   hover:bg-gray-50 transition"
                        >
                            Edit
                        </a>


                        <form
                            method="POST"
                            action="{{ route(
                                'instructor.projects.destroy',
                                [
                                    'classId' => $class->id,
                                    'projectId' => $project->id
                                ]
                            ) }}"
                            class="flex-1"
                            onsubmit="return confirm(
                                'Are you sure you want to delete this project?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full px-4 py-2 rounded-lg
                                       bg-red-50 text-red-600
                                       font-medium hover:bg-red-100
                                       transition"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    p-12 text-center">

            <div class="text-5xl mb-4">
                📁
            </div>

            <h2 class="text-xl font-bold text-gray-900">
                No projects yet
            </h2>

            <p class="text-gray-500 mt-2">
                Create the first project for this class.
            </p>

            <a
                href="{{ route(
                    'instructor.projects.create',
                    $class->id
                ) }}"
                class="inline-block mt-6 px-5 py-3
                       bg-purple-600 text-white rounded-xl
                       font-semibold hover:bg-purple-700 transition"
            >
                Create Project
            </a>

        </div>

    @endif

</div>

@endsection