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

        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

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
        action="{{ route('instructor.projects.store', $class->id) }}"
        class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8"
    >

        @csrf


        {{-- Project Title --}}
        <div class="mb-6">

            <label
                for="title"
                class="block text-sm font-semibold text-gray-700 mb-2"
            >
                Project Title
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="e.g. Online Library System"
                required
                class="w-full px-4 py-3 rounded-xl border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >

        </div>


        {{-- Description --}}
        <div class="mb-6">

            <label
                for="description"
                class="block text-sm font-semibold text-gray-700 mb-2"
            >
                Project Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Describe the project..."
                class="w-full px-4 py-3 rounded-xl border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >{{ old('description') }}</textarea>

        </div>


        {{-- Dates --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

            {{-- Start Date --}}
            <div>

                <label
                    for="start_date"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    Start Date
                </label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-purple-500
                           focus:border-purple-500
                           outline-none"
                >

            </div>


            {{-- End Date --}}
            <div>

                <label
                    for="end_date"
                    class="block text-sm font-semibold text-gray-700 mb-2"
                >
                    End Date
                </label>

                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ old('end_date') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
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
                class="block text-sm font-semibold text-gray-700 mb-2"
            >
                Status
            </label>

            <select
                id="status"
                name="status"
                class="w-full px-4 py-3 rounded-xl border border-gray-300
                       focus:ring-2 focus:ring-purple-500
                       focus:border-purple-500
                       outline-none"
            >

                <option
                    value="Active"
                    {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="Draft"
                    {{ old('status') === 'Draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="Completed"
                    {{ old('status') === 'Completed' ? 'selected' : '' }}
                >
                    Completed
                </option>

            </select>

        </div>


        {{-- Assign Project to Groups --}}
        <div class="mb-8">

            <div class="mb-4">

                <h2 class="text-lg font-bold text-gray-800">
                    Assign Project to Groups
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Select the groups that will work on this project.
                </p>

            </div>


            {{-- Groups --}}
            <div class="space-y-4">

                @forelse($groups as $group)

                    <label
                        class="flex items-start gap-4 p-4 rounded-xl
                               border border-gray-200
                               hover:bg-purple-50
                               hover:border-purple-300
                               cursor-pointer transition"
                    >

                        <input
                            type="checkbox"
                            name="groups[]"
                            value="{{ $group->id }}"
                            {{ in_array($group->id, old('groups', [])) ? 'checked' : '' }}
                            class="mt-1 w-5 h-5 text-purple-600
                                   border-gray-300 rounded
                                   focus:ring-purple-500"
                        >

                        <div class="flex-1">

                            <div class="flex items-center justify-between">

                                <h3 class="font-semibold text-gray-800">
                                    {{ $group->name }}
                                </h3>

                                <span class="text-sm text-gray-500">
                                    {{ $group->students->count() }} member(s)
                                </span>

                            </div>


                            {{-- Group Members --}}
                            <div class="mt-2 flex flex-wrap gap-2">

                                @forelse($group->students as $student)

                                    <span
                                        class="px-3 py-1 text-xs rounded-full
                                               bg-gray-100 text-gray-600"
                                    >
                                        {{ $student->name }}

                                        @if($student->pivot->is_leader)
                                            <span class="font-semibold text-purple-600">
                                                (Leader)
                                            </span>
                                        @endif
                                    </span>

                                @empty

                                    <span class="text-sm text-red-500">
                                        No members assigned
                                    </span>

                                @endforelse

                            </div>

                        </div>

                    </label>

                @empty

                    <div
                        class="p-6 rounded-xl bg-yellow-50
                               border border-yellow-200"
                    >

                        <p class="font-semibold text-yellow-800">
                            No groups available.
                        </p>

                        <p class="text-sm text-yellow-700 mt-1">
                            Please create student groups before creating
                            a project.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Buttons --}}
        <div class="flex items-center justify-end gap-3">

            <a
                href="{{ route('instructor.projects.index', $class->id) }}"
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