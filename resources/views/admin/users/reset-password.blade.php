@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto p-8">

    {{-- Header --}}
    <div class="mb-6">

        <a
            href="{{ route('users.index') }}"
            class="inline-flex items-center text-sm
                   text-gray-500 hover:text-purple-600
                   transition">

            ← Back to Users

        </a>

        <h1 class="text-3xl font-bold text-gray-800 mt-4">
            Reset Password
        </h1>

        <p class="text-gray-500 mt-1">
            Set a new password for this user.
        </p>

    </div>


    {{-- User Information --}}
    <div class="bg-gray-50 border border-gray-200
                rounded-xl p-5 mb-6">

        <p class="text-sm text-gray-500">
            User
        </p>

        <p class="font-semibold text-lg text-gray-800">
            {{ $user->name }}
        </p>

        <p class="text-gray-500">
            {{ $user->email }}
        </p>

        <div class="mt-2">
            <span class="inline-block
                         bg-purple-100 text-purple-700
                         text-xs font-semibold
                         px-3 py-1 rounded-full">

                {{ $user->role }}

            </span>
        </div>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="bg-red-50
                    border border-red-200
                    text-red-700
                    rounded-xl
                    p-4 mb-6">

            <ul class="list-disc list-inside space-y-1">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Reset Password Form --}}
    <div class="bg-white
                border border-gray-200
                rounded-2xl
                shadow-sm
                p-8">

        <form
            action="{{ route('users.password.update', $user) }}"
            method="POST">

            @csrf

            @method('PUT')


            {{-- New Password --}}
            <div class="mb-5">

                <label
                    for="password"
                    class="block text-sm
                           font-semibold
                           text-gray-700 mb-2">

                    New Password

                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter new password"
                    class="w-full
                           border border-gray-300
                           rounded-xl
                           px-4 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-purple-500
                           focus:border-purple-500"
                    required>

                <p class="text-sm text-gray-500 mt-2">
                    Password must be at least 8 characters.
                </p>

            </div>


            {{-- Confirm Password --}}
            <div class="mb-6">

                <label
                    for="password_confirmation"
                    class="block text-sm
                           font-semibold
                           text-gray-700 mb-2">

                    Confirm New Password

                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm new password"
                    class="w-full
                           border border-gray-300
                           rounded-xl
                           px-4 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-purple-500
                           focus:border-purple-500"
                    required>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="bg-purple-600
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold
                           hover:bg-purple-700
                           transition">

                    Reset Password

                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="bg-gray-500
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold
                           hover:bg-gray-600
                           transition">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection