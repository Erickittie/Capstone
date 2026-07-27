@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <h1 class="text-3xl font-bold mb-6">
        View Class
    </h1>

    <div class="bg-white rounded-lg shadow p-6 space-y-4">

        <div>
            <strong>Course Code:</strong>
            {{ $class->course_code }}
        </div>

        <div>
            <strong>Course Name:</strong>
            {{ $class->course_name }}
        </div>

        <div>
            <strong>Section:</strong>
            {{ $class->section }}
        </div>

        <div>
            <strong>Semester:</strong>
            {{ $class->semester }}
        </div>

        <div>
            <strong>Academic Year:</strong>
            {{ $class->academic_year }}
        </div>

        <div>
            <strong>Instructor:</strong>
            {{ $class->instructor?->name ?? 'No Instructor Assigned' }}
        </div>

    </div>

    <div class="mt-6">

        <a href="{{ route('classes.index') }}"
           class="bg-gray-600 text-white px-6 py-3 rounded">

            Back

        </a>

    </div>

</div>

@endsection