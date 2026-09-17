@extends('layouts.instructor')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            My Classes
        </h1>

        <p class="text-gray-500 mt-1">
            Classes assigned to you
        </p>
    </div>


    {{-- Classes --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($classes as $class)

            <a href="{{ route('instructor.class.configure', $class->id) }}"
               class="block bg-white rounded-2xl border border-gray-200
                      p-6 hover:shadow-lg hover:border-blue-300
                      transition duration-200 cursor-pointer">

                {{-- Course Code --}}
                <div class="flex items-center justify-between">

                    <span class="px-3 py-1 rounded-full
                                 bg-blue-100 text-blue-700
                                 text-xs font-semibold">
                        {{ $class->course_code }}
                    </span>

                    <span class="text-2xl">
                        📚
                    </span>

                </div>


                {{-- Course Name --}}
                <h2 class="text-xl font-bold text-gray-800 mt-5">
                    {{ $class->course_name }}
                </h2>


                {{-- Class Information --}}
                <div class="mt-4 space-y-2">

                    {{-- Offer Code --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <span class="font-semibold text-gray-700">
                            Offer Code:
                        </span>

                        <span>
                            {{ $class->offer_code }}
                        </span>
                    </div>


                    {{-- Semester --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <span class="font-semibold text-gray-700">
                            Semester:
                        </span>

                        <span>
                            {{ $class->semester }}
                        </span>
                    </div>


                    {{-- Academic Year --}}
                    <div class="flex items-center gap-2 text-gray-600">
                        <span class="font-semibold text-gray-700">
                            Academic Year:
                        </span>

                        <span>
                            {{ $class->academic_year }}
                        </span>
                    </div>

                </div>


                {{-- Configure Class --}}
                <div class="mt-6 pt-4 border-t border-gray-100">

                    <span class="text-blue-600 font-semibold">
                        Configure Class →
                    </span>

                </div>

            </a>

        @empty

            {{-- Empty State --}}
            <div class="col-span-full bg-white border
                        border-gray-200 rounded-2xl p-10 text-center">

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