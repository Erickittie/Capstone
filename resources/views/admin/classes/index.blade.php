@extends('layouts.app')

@section('content')

<div class="p-8">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Classes
        </h1>

        <a href="{{ route('classes.create') }}"
           class="bg-blue-600 text-white px-5 py-3 rounded hover:bg-blue-700">
            Add Class
        </a>

    </div>

    <table class="w-full border border-gray-300">

        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Course Code</th>
                <th class="border p-3">Course Name</th>
                <th class="border p-3">Section</th>
                <th class="border p-3">Semester</th>
                <th class="border p-3">Academic Year</th>
                <th class="border p-3">Instructor</th>
                <th class="border p-3">Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($classes as $class)

            <tr>

                <td class="border p-3">
                    {{ $class->course_code }}
                </td>

                <td class="border p-3">
                    {{ $class->course_name }}
                </td>

                <td class="border p-3">
                    {{ $class->section }}
                </td>

                <td class="border p-3">
                    {{ $class->semester }}
                </td>

                <td class="border p-3">
                    {{ $class->academic_year }}
                </td>

                <td class="border p-3">
                    {{ $class->instructor?->name ?? 'No Instructor Assigned' }}
                </td>

                <td class="border p-3">

                    <div class="flex items-center gap-2">

                        <a href="{{ route('classes.show', $class) }}"
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            View
                        </a>

                        <a href="{{ route('classes.edit', $class) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('classes.destroy', $class) }}"
                              method="POST"
                              class="inline-block m-0">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this class?')"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Delete
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center p-4">
                    No classes found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="mt-6">
        {{ $classes->links() }}
    </div>

</div>

@endsection