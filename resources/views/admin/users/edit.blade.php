@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow">

    <h1 class="text-3xl font-bold mb-6">
        Edit User
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full border rounded p-3">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full border rounded p-3">
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Role
            </label>

            <select
                name="role"
                class="w-full border rounded p-3">

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

        <!-- Department -->
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Department
            </label>

            <input
                type="text"
                name="department"
                value="{{ old('department', $user->department) }}"
                class="w-full border rounded p-3">
        </div>

        <!-- Status -->
        <div class="mb-6">
            <label class="block mb-2 font-semibold">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded p-3">

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

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">
                Update User
            </button>

            <a href="{{ route('users.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection