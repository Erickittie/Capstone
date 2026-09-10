@extends('layouts.student')

@section('title', 'Create Task')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="mb-8">

        <a href="{{ route('student.project.show', [
            'classId' => $class->id,
            'projectId' => $project->id
        ]) }}"
           class="text-sm text-purple-600 hover:text-purple-800">

            ← Back to Project

        </a>

        <h1 class="text-3xl font-bold text-gray-900 mt-4">
            Create Task
        </h1>

        <p class="text-gray-500 mt-1">
            {{ $project->title }}
        </p>

    </div>


    {{-- Form --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

        <form method="POST"
              action="{{ route('student.tasks.store', [
                  'classId' => $class->id,
                  'projectId' => $project->id
              ]) }}">

            @csrf


            {{-- Task Title --}}

            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Task Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Create Database ERD"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    required
                >

                @error('title')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Description --}}

            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Describe what needs to be completed..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Points + Due Date --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Task Points
                    </label>

                    <input
                        type="number"
                        name="points"
                        value="{{ old('points', 5) }}"
                        min="1"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        required
                    >

                    @error('points')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Due Date
                    </label>

                    <input
                        type="date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3
                               focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    >

                    @error('due_date')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Assign To --}}

            <div class="mb-8">

                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Assign Task To
                </label>

                <div class="border border-gray-200 rounded-xl divide-y">

                    @foreach($group->students as $member)

                        <label class="flex items-center gap-3 p-4 hover:bg-gray-50 cursor-pointer">

                            <input
                                type="checkbox"
                                name="assignees[]"
                                value="{{ $member->id }}"
                                class="w-5 h-5 text-purple-600 rounded"
                                {{ in_array(
                                    $member->id,
                                    old('assignees', [])
                                ) ? 'checked' : '' }}
                            >

                            <div>

                                <p class="font-medium text-gray-900">
                                    {{ $member->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $member->student_id }}

                                    @if($member->pivot->is_leader)
                                        <span class="text-purple-600 font-medium">
                                            • Group Leader / PM
                                        </span>
                                    @endif
                                </p>

                            </div>

                        </label>

                    @endforeach

                </div>

                @error('assignees')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

                <p class="text-xs text-gray-500 mt-2">
                    You can assign one task to one or multiple members of your group.
                </p>

            </div>


            {{-- Buttons --}}

            <div class="flex justify-end gap-3">

                <a href="{{ route('student.project.show', [
                    'classId' => $class->id,
                    'projectId' => $project->id
                ]) }}"
                   class="px-6 py-3 rounded-xl border border-gray-300
                          text-gray-700 hover:bg-gray-50">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-purple-600 text-white
                           font-semibold hover:bg-purple-700 transition">

                    Create & Assign Task

                </button>

            </div>

        </form>

    </div>

</div>

@endsection