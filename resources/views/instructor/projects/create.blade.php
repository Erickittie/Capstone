@extends('layouts.instructor')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a
            href="{{ route('instructor.projects.index', $class->id) }}"
            class="text-sm text-purple-600 hover:text-purple-700"
        >
            ← Back to Projects
        </a>

        <h1 class="text-3xl font-bold text-gray-900 mt-4">
            Create Project
        </h1>

        <p class="text-gray-500 mt-1">
            Create a new project for
            {{ $class->course_code }} - {{ $class->section }}
        </p>
    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-6 p-4 rounded-xl bg-red-50
                    border border-red-200">

            <p class="font-semibold text-red-700 mb-2">
                Please fix the following:
            </p>

            <ul class="list-disc list-inside text-sm text-red-600">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form
        method="POST"
        action="{{ route(
            'instructor.projects.store',
            $class->id
        ) }}"
        class="bg-white rounded-2xl border border-gray-200
               shadow-sm p-8"
    >

        @csrf


        {{-- Project Title --}}
        <div class="mb-6">

            <label
                for="title"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Project Title
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="e.g. Capstone Project"
                required
                class="w-full px-4 py-3 rounded-xl
                       border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >

        </div>


        {{-- Description --}}
        <div class="mb-6">

            <label
                for="description"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Project Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Describe the project..."
                class="w-full px-4 py-3 rounded-xl
                       border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >{{ old('description') }}</textarea>

        </div>


        {{-- Dates --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            <div>

                <label
                    for="start_date"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Start Date
                </label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    class="w-full px-4 py-3 rounded-xl
                           border border-gray-300
                           focus:ring-2 focus:ring-purple-500
                           focus:border-purple-500
                           outline-none"
                >

            </div>


            <div>

                <label
                    for="end_date"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    End Date
                </label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ old('end_date') }}"
                    class="w-full px-4 py-3 rounded-xl
                           border border-gray-300
                           focus:ring-2 focus:ring-purple-500
                           focus:border-purple-500
                           outline-none"
                >

            </div>

        </div>


        {{-- Status --}}
        <div class="mb-8">

            <label
                for="status"
                class="block text-sm font-semibold
                       text-gray-700 mb-2"
            >
                Status
            </label>

            <select
                id="status"
                name="status"
                class="w-full px-4 py-3 rounded-xl
                       border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >

                <option
                    value="Active"
                    {{ old('status', 'Active') === 'Active'
                        ? 'selected'
                        : ''
                    }}
                >
                    Active
                </option>

                <option
                    value="Draft"
                    {{ old('status') === 'Draft'
                        ? 'selected'
                        : ''
                    }}
                >
                    Draft
                </option>

                <option
                    value="Completed"
                    {{ old('status') === 'Completed'
                        ? 'selected'
                        : ''
                    }}
                >
                    Completed
                </option>

            </select>

        </div>


        {{-- Buttons --}}
        <div class="flex items-center justify-end gap-3">

            <a
                href="{{ route(
                    'instructor.projects.index',
                    $class->id
                ) }}"
                class="px-5 py-3 rounded-xl
                       border border-gray-300
                       text-gray-700 font-semibold
                       hover:bg-gray-50 transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl
                       bg-purple-600 text-white
                       font-semibold
                       hover:bg-purple-700 transition"
            >
                Create Project
            </button>

        </div>

    </form>

</div>

@endsection