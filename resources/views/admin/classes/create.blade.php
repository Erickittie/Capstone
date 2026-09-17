@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">
        Create Class
    </h1>

    <form action="{{ route('classes.store') }}" method="POST">

        @csrf


        {{-- Course Code --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Course Code
            </label>

            <input
                type="text"
                name="course_code"
                value="{{ old('course_code') }}"
                class="w-full border rounded p-3"
                placeholder="e.g. CS101"
                required>

        </div>


        {{-- Course Name --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Course Name
            </label>

            <input
                type="text"
                name="course_name"
                value="{{ old('course_name') }}"
                class="w-full border rounded p-3"
                placeholder="e.g. Computer Programming 1"
                required>

        </div>


        {{-- Offer Code --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Offer Code
            </label>

            <input
                type="text"
                name="offer_code"
                value="{{ old('offer_code') }}"
                class="w-full border rounded p-3"
                placeholder="e.g. IT1_1"
                required>

            <p class="text-sm text-gray-500 mt-1">
                Enter the official offering code for this class.
            </p>

        </div>


        {{-- Semester --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Semester
            </label>

            <select
                name="semester"
                class="w-full border rounded p-3"
                required>

                <option value="">
                    Choose Semester
                </option>

                <option
                    value="1st Semester"
                    {{ old('semester') == '1st Semester' ? 'selected' : '' }}>

                    1st Semester

                </option>

                <option
                    value="2nd Semester"
                    {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>

                    2nd Semester

                </option>

                <option
                    value="Summer"
                    {{ old('semester') == 'Summer' ? 'selected' : '' }}>

                    Summer

                </option>

            </select>

        </div>


        {{-- Academic Year --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Academic Year
            </label>

            <select
                name="academic_year"
                class="w-full border rounded p-3"
                required>

                <option value="">
                    Choose Academic Year
                </option>

                <option
                    value="2025-2026"
                    {{ old('academic_year') == '2025-2026' ? 'selected' : '' }}>

                    2025-2026

                </option>

                <option
                    value="2026-2027"
                    {{ old('academic_year') == '2026-2027' ? 'selected' : '' }}>

                    2026-2027

                </option>

                <option
                    value="2027-2028"
                    {{ old('academic_year') == '2027-2028' ? 'selected' : '' }}>

                    2027-2028

                </option>

                <option
                    value="2028-2029"
                    {{ old('academic_year') == '2028-2029' ? 'selected' : '' }}>

                    2028-2029

                </option>

                <option
                    value="2029-2030"
                    {{ old('academic_year') == '2029-2030' ? 'selected' : '' }}>

                    2029-2030

                </option>

            </select>

        </div>


        {{-- Instructor --}}
        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Instructor
            </label>

            <select
                name="Instructor_Id"
                class="w-full border rounded p-3"
                required>

                <option value="">
                    Choose Instructor
                </option>

                @foreach($instructors as $instructor)

                    <option
                        value="{{ $instructor->id }}"
                        {{ old('Instructor_Id') == $instructor->id ? 'selected' : '' }}>

                        {{ $instructor->name }}

                    </option>

                @endforeach

            </select>

        </div>


        {{-- Save Button --}}
        <button
            type="submit"
            class="bg-blue-600 text-white
                   px-6 py-3 rounded
                   hover:bg-blue-700">

            Save Class

        </button>

    </form>

</div>

@endsection