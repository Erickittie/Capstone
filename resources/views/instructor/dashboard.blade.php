@extends('layouts.instructor')

@section('content')

<div>

    <h1 class="text-3xl font-bold text-gray-800">
        My Classes
    </h1>

    <p class="text-gray-500 mt-1">
        Classes assigned to you
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

        @forelse($classes as $class)

            <a href="{{ route('instructor.class.configure', $class->id) }}"
               class="block bg-white rounded-xl border border-gray-200 p-6
                      hover:shadow-lg hover:border-blue-300
                      transition cursor-pointer">

                <div class="flex items-center justify-between">

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                        {{ $class->course_code }}
                    </span>

                    <span class="text-2xl">
                        📚
                    </span>

                </div>

                <h2 class="text-xl font-bold text-gray-800 mt-5">
                    {{ $class->course_name }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Section: {{ $class->section }}
                </p>

                <p class="text-gray-500">
                    {{ $class->semester }} • {{ $class->academic_year }}
                </p>

                <div class="mt-6 text-blue-600 font-semibold">
                    Configure Class →
                </div>

            </a>

        @empty

            <div class="col-span-full bg-white border rounded-xl p-10 text-center">

                <div class="text-5xl mb-4">
                    📚
                </div>

                <h2 class="text-xl font-semibold text-gray-800">
                    No Classes Assigned
                </h2>

                <p class="text-gray-500 mt-2">
                    Classes assigned to your account will appear here.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection