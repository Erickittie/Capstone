@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-1 text-xs font-semibold text-gray-500 hover:text-gray-900 mb-2 transition">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Back to Users</span>
        </a>

        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Edit User
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Update account details, role, ID number, department, or status for {{ $user->name }}.
        </p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-gray-200/80 p-8 shadow-sm">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                <p class="font-semibold mb-1">Please correct the following errors:</p>

                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}"
              method="POST"
              class="space-y-5">

            @csrf
            @method('PUT')

            {{-- Full Name --}}
            <div>
                <label for="name"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Full Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            {{-- Email --}}
            <div>
                <label for="email"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Academic Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            {{-- Role --}}
            <div>
                <label for="role"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Account Role
                </label>

                <select
                    name="role"
                    id="role"
                    onchange="toggleIdFields(this.value)"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>

                    <option value="Admin"
                        {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="Instructor"
                        {{ old('role', $user->role) == 'Instructor' ? 'selected' : '' }}>
                        Instructor
                    </option>

                    <option value="Student"
                        {{ old('role', $user->role) == 'Student' ? 'selected' : '' }}>
                        Student
                    </option>

                </select>
            </div>

            {{-- Student ID --}}
            <div id="student-id-container"
                 class="{{ old('role', $user->role) == 'Student' ? '' : 'hidden' }}">

                <label for="student_id"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Student ID Number
                </label>

                <input
                    type="text"
                    name="student_id"
                    id="student_id"
                    value="{{ old('student_id', $user->student_id) }}"
                    placeholder="e.g. 2026-0001"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">

                <p class="text-xs text-gray-400 mt-1">
                    Required for Student accounts.
                </p>
            </div>

            {{-- Instructor ID --}}
            <div id="instructor-id-container"
                 class="{{ old('role', $user->role) == 'Instructor' ? '' : 'hidden' }}">

                <label for="instructor_id"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Instructor ID
                </label>

                <input
                    type="text"
                    name="instructor_id"
                    id="instructor_id"
                    value="{{ old('instructor_id', $user->instructor_id ?? '') }}"
                    placeholder="e.g. INS-2026-001"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">

                <p class="text-xs text-gray-400 mt-1">
                    Required for Instructor accounts.
                </p>
            </div>

            {{-- Department --}}
            <div>
                <label for="department"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Department
                </label>

                <select
                    name="department"
                    id="department"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>

                    <option value="">Select Department</option>

                    @foreach ($departments as $department)
                        <option
                            value="{{ $department }}"
                            {{ old('department', $user->department) == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach

                </select>

                @error('department')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror

                <p class="text-xs text-gray-400 mt-1">
                    Select an approved department.
                </p>
            </div>

            {{-- Status --}}
            <div>
                <label for="status"
                       class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>

                    <option value="Active"
                        {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive"
                        {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-sm hover:shadow transition duration-150">
                    Update User
                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold transition">
                    Cancel
                </a>

            </div>

        </form>
    </div>
</div>

{{-- Show the ID field that matches the selected role --}}
<script>
    function toggleIdFields(role) {
        const studentContainer = document.getElementById('student-id-container');
        const instructorContainer = document.getElementById('instructor-id-container');

        const studentInput = document.getElementById('student_id');
        const instructorInput = document.getElementById('instructor_id');

        studentContainer.classList.toggle('hidden', role !== 'Student');
        instructorContainer.classList.toggle('hidden', role !== 'Instructor');

        studentInput.disabled = role !== 'Student';
        instructorInput.disabled = role !== 'Instructor';

        studentInput.required = role === 'Student';
        instructorInput.required = role === 'Instructor';
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleIdFields(document.getElementById('role').value);
    });
</script>

@endsection