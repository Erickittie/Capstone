
@extends('layouts.admin')

@section('title', 'Create User - CarryOn')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <h1 style="background: red; color: white; padding: 20px;">
    TEST - CORRECT CREATE USER PAGE
</h1>

    <div>
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 mb-3">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            Back to Users
        </a>

        <h1 class="text-2xl font-bold text-gray-900">Create User</h1>
        <p class="text-sm text-gray-500 mt-1">
            Create an administrator, instructor, or student account.
        </p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name *
                </label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}" placeholder="Enter full name"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm"
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address *
                </label>
                <input type="email" name="email" id="email"
                       value="{{ old('email') }}" placeholder="Enter email address"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm"
                       required>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password *
                </label>
                <input type="password" name="password" id="password" minlength="8"
                       placeholder="At least 8 characters"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm"
                       required>
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                    Account Role *
                </label>
                <select name="role" id="role"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm"
                        required>
                    <option value="Student" {{ old('role', 'Student') === 'Student' ? 'selected' : '' }}>
                        Student
                    </option>
                    <option value="Instructor" {{ old('role') === 'Instructor' ? 'selected' : '' }}>
                        Instructor
                    </option>
                    <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
            </div>

            <div id="student-id-container">
                <label for="student_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Student ID Number *
                </label>
                <input type="text" name="student_id" id="student_id"
                       value="{{ old('student_id') }}"
                       placeholder="Enter student ID number"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm">
                <p class="mt-1 text-xs text-gray-400">Required only for Student accounts.</p>
            </div>

            <div id="instructor-id-container" style="display: block !important;">
                <label for="instructor_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Instructor ID Number *
                </label>
                <input type="text" name="instructor_id" id="instructor_id"
                       value="{{ old('instructor_id') }}"
                       placeholder="Enter instructor ID number"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm">
                <p class="mt-1 text-xs text-gray-400">Required only for Instructor accounts.</p>
            </div>

            <div>
                <label for="department" class="block text-sm font-semibold text-gray-700 mb-2">
                    Department
                </label>
                <input type="text" name="department" id="department"
                       value="{{ old('department') }}" placeholder="Enter department"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm">
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Account Status *
                </label>
                <select name="status" id="status"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm"
                        required>
                    <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <div class="flex gap-3 border-t border-gray-100 pt-5">
                <button type="submit"
                        class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Create User
                </button>

                <a href="{{ route('users.index') }}"
                   class="rounded-xl border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
(function () {
    function initializeIdFields() {
        const roleSelect = document.getElementById('role');
        const studentContainer = document.getElementById('student-id-container');
        const instructorContainer = document.getElementById('instructor-id-container');
        const studentInput = document.getElementById('student_id');
        const instructorInput = document.getElementById('instructor_id');

        if (!roleSelect || !studentContainer || !instructorContainer ||
            !studentInput || !instructorInput) {
            console.error('Create User form: one or more ID fields were not found.');
            return;
        }

        function toggleIdFields() {
            const role = roleSelect.value;

            studentContainer.hidden = role !== 'Student';
            instructorContainer.hidden = role !== 'Instructor';

            studentInput.disabled = role !== 'Student';
            studentInput.required = role === 'Student';

            instructorInput.disabled = role !== 'Instructor';
            instructorInput.required = role === 'Instructor';
        }

        roleSelect.addEventListener('change', toggleIdFields);
        toggleIdFields();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeIdFields);
    } else {
        initializeIdFields();
    }
})();
</script>
@endsection
