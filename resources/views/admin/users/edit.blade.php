@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-gray-500 hover:text-gray-900 mb-2 transition">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Back to Users</span>
            </a>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Edit User
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Update account credentials, assigned role, or status for {{ $user->name }}.
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

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
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
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
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
                <label for="role" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Account Role
                </label>
                <select
                    name="role"
                    id="role"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Instructor" {{ old('role', $user->role) == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                    <option value="Student" {{ old('role', $user->role) == 'Student' ? 'selected' : '' }}>Student</option>
                </select>
            </div>

            {{-- Student ID --}}
            <div id="student-id-container" class="{{ old('role', $user->role) == 'Student' ? '' : 'hidden' }}">
                <label for="student_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
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

            {{-- Department --}}
            <div>
                <label for="department" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Department
                </label>
                <input
                    type="text"
                    name="department"
                    value="{{ old('department', $user->department) }}"
                    placeholder="e.g. Computer Science"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                    Status
                </label>
                <select
                    name="status"
                    id="status"
                    class="w-full h-11 px-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                    <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow transition duration-150">
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

@endsection
