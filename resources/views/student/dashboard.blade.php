@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Welcome, {{ $student->name }}
    </h1>

    <p class="text-gray-500 mt-1">
        Here are your enrolled classes and project activities.
    </p>

</div>


<!-- STAT CARDS -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-500">
            Enrolled Classes
        </p>

        <h2 class="text-3xl font-bold text-gray-800 mt-2">
            {{ $classes->count() }}
        </h2>
    </div>


    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-500">
            Active Projects
        </p>

        <h2 class="text-3xl font-bold text-gray-800 mt-2">
            0
        </h2>
    </div>


    <div class="bg-white rounded-xl shadow-sm border p-6">
        <p class="text-sm text-gray-500">
            Pending Tasks
        </p>

        <h2 class="text-3xl font-bold text-gray-800 mt-2">
            0
        </h2>
    </div>

</div>


<!-- MY CLASSES -->

<div class="bg-white rounded-xl shadow-sm border">

    <div class="p-6 border-b">

        <h2 class="text-xl font-bold text-gray-800">
            My Classes
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Classes where you are currently enrolled.
        </p>

    </div>


    <div class="p-6">

        @if($classes->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach($classes as $class)

                    <a
                        href="{{ route('student.class.detail', $class->id) }}"
                        class="block border rounded-xl p-5 hover:border-blue-500
                               hover:shadow-md transition">

                        <div class="flex justify-between items-start">

                            <div>

                                <p class="text-sm text-blue-600 font-semibold">
                                    {{ $class->course_code }}
                                </p>

                                <h3 class="text-lg font-bold text-gray-800 mt-1">
                                    {{ $class->course_name }}
                                </h3>

                            </div>

                            <span class="text-blue-600">
                                →
                            </span>

                        </div>


                        <div class="mt-4 space-y-2 text-sm text-gray-500">

                            <p>
                                Section:
                                <span class="font-medium text-gray-700">
                                    {{ $class->section }}
                                </span>
                            </p>

                            <p>
                                Instructor:
                                <span class="font-medium text-gray-700">
                                    {{ $class->instructor->name ?? 'N/A' }}
                                </span>
                            </p>

                            <p>
                                {{ $class->semester }}
                                ·
                                {{ $class->academic_year }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div class="text-center py-12">

                <div class="text-5xl mb-4">
                    📚
                </div>

                <h3 class="text-lg font-semibold text-gray-700">
                    No Classes Yet
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    You will see your class here once your instructor
                    imports your student information.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection