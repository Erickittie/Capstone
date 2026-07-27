@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">
        Edit Class
    </h1>

    <form action="{{ route('classes.update', $class) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Course Code
            </label>

            <input
                type="text"
                name="course_code"
                value="{{ old('course_code', $class->course_code) }}"
                class="w-full border rounded p-3"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Course Name
            </label>

            <input
                type="text"
                name="course_name"
                value="{{ old('course_name', $class->course_name) }}"
                class="w-full border rounded p-3"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Section
            </label>

            <input
                type="text"
                name="section"
                value="{{ old('section', $class->section) }}"
                class="w-full border rounded p-3"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Semester
            </label>

            <input
                type="text"
                name="semester"
                value="{{ old('semester', $class->semester) }}"
                class="w-full border rounded p-3"
                required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Academic Year
            </label>

            <input
                type="text"
                name="academic_year"
                value="{{ old('academic_year', $class->academic_year) }}"
                class="w-full border rounded p-3"
                required>
        </div>

        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Instructor
            </label>

            <select
                name="Instructor_Id"
                class="w-full border rounded p-3"
                required>

                <option value="">Choose Instructor</option>

                @foreach($instructors as $instructor)

                    <option
                        value="{{ $instructor->id }}"
                        {{ old('Instructor_Id', $class->Instructor_Id) == $instructor->id ? 'selected' : '' }}>

                        {{ $instructor->name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">

                Update Class

            </button>

            <a
                href="{{ route('classes.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection