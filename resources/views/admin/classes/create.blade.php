@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('classes.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-gray-500 hover:text-gray-900 mb-2 transition">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Back to Classes</span>
            </a>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Create Class
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Configure a new course section and assign a lead instructor.
            </p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-8 shadow-xs">

        @if ($errors->any())
            <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                <span class="material-symbols-outlined text-red-500 text-[20px] mt-0.5">error</span>
                <div>
                    <p class="font-semibold">Please correct the following errors:</p>
                    <ul class="list-disc list-inside mt-1 text-xs space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('classes.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="course_code" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Course Code
                </label>
                <input
                    id="course_code"
                    type="text"
                    name="course_code"
                    value="{{ old('course_code') }}"
                    placeholder="e.g. CS402"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            <div>
                <label for="course_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Course Name
                </label>
                <input
                    id="course_name"
                    type="text"
                    name="course_name"
                    value="{{ old('course_name') }}"
                    placeholder="e.g. Advanced Software Engineering & Capstone"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="section" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                        Section
                    </label>
                    <input
                        id="section"
                        type="text"
                        name="section"
                        value="{{ old('section') }}"
                        placeholder="e.g. 1A"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>

                <div>
                    <label for="semester" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                        Semester
                    </label>
                    <input
                        id="semester"
                        type="text"
                        name="semester"
                        value="{{ old('semester') }}"
                        placeholder="e.g. 1st Semester"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>

                <div>
                    <label for="academic_year" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                        Academic Year
                    </label>
                    <input
                        id="academic_year"
                        type="text"
                        name="academic_year"
                        value="{{ old('academic_year') }}"
                        placeholder="e.g. 2026-2027"
                        class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>
            </div>

            <div>
                <label for="Instructor_Id" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Lead Instructor
                </label>
                <select
                    name="Instructor_Id"
                    id="Instructor_Id"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
                    <option value="">Choose Instructor</option>
                    @foreach($instructors as $instructor)
                        <option
                            value="{{ $instructor->id }}"
                            {{ old('Instructor_Id') == $instructor->id ? 'selected' : '' }}>
                            {{ $instructor->name }} ({{ $instructor->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow transition duration-150">
                    Save Class
                </button>

                <a
                    href="{{ route('classes.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold transition">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

@endsection