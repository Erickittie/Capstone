@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-8">

    <div class="mb-6">
        <h1 class="text-3xl font-bold">Create User</h1>
        <p class="text-gray-500">Add a new user to the system.</p>
    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-5">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Full Name

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded p-3">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Email

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded p-3">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Password

            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded p-3">

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Role

            </label>

            <select
                name="role"
                class="w-full border rounded p-3">

                <option value="">Choose Role</option>

                <option value="Admin">Admin</option>

                <option value="Instructor">Instructor</option>

                <option value="Student">Student</option>

            </select>

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Department

            </label>

            <input
                type="text"
                name="department"
                class="w-full border rounded p-3">

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">

                Status

            </label>

            <select
                name="status"
                class="w-full border rounded p-3">

                <option value="Active">Active</option>

                <option value="Inactive">Inactive</option>

            </select>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded">

                Save User

            </button>

            <a
                href="{{ route('users.index') }}"
                class="bg-gray-500 text-white px-6 py-3 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection