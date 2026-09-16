@extends('layouts.admin')

@section('content')

<div class="p-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center
                md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Users
            </h1>

            <p class="text-gray-500 mt-1">
                Manage system users, accounts, and passwords.
            </p>
        </div>


        <div class="flex flex-wrap gap-3">

            {{-- Add User --}}
            <a
                href="{{ route('users.create') }}"
                class="bg-blue-600 text-white
                       px-4 py-2 rounded-lg
                       font-semibold
                       hover:bg-blue-700
                       transition">

                + Add User

            </a>


            {{-- Bulk Registration --}}
            <a
                href="{{ route('admin.users.bulk-register') }}"
                class="bg-purple-600 text-white
                       px-4 py-2 rounded-lg
                       font-semibold
                       hover:bg-purple-700
                       transition">

                📥 Bulk Registration

            </a>

        </div>

    </div>


    {{-- Search --}}
    <form
        method="GET"
        action="{{ route('users.index') }}"
        class="mb-5">

        <div class="flex gap-2">

            <input
                type="text"
                name="search"
                placeholder="Search by name or email..."
                class="border border-gray-300
                       rounded-lg
                       px-4 py-2
                       w-full md:w-80
                       focus:outline-none
                       focus:ring-2
                       focus:ring-blue-500"
                value="{{ request('search') }}">


            <button
                type="submit"
                class="bg-gray-800 text-white
                       px-5 py-2
                       rounded-lg
                       hover:bg-gray-900
                       transition">

                Search

            </button>

        </div>

    </form>


    {{-- Success Message --}}
    @if(session('success'))

        <div
            class="bg-green-100
                   border border-green-500
                   text-green-700
                   p-4 rounded-lg
                   mb-5">

            {{ session('success') }}

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div
            class="bg-red-100
                   border border-red-500
                   text-red-700
                   p-4 rounded-lg
                   mb-5">

            {{ session('error') }}

        </div>

    @endif


    {{-- Users Table --}}
    <div
        class="bg-white
               border border-gray-200
               rounded-xl
               shadow-sm
               overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-gray-100 border-b">

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Name
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Email
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Role
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="p-4 text-left font-semibold text-gray-700">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($users as $user)

                    <tr
                        class="border-b
                               last:border-b-0
                               hover:bg-gray-50
                               transition">

                        {{-- Name --}}
                        <td class="p-4">

                            <div class="font-semibold text-gray-800">
                                {{ $user->name }}
                            </div>

                            @if($user->student_id)

                                <div class="text-sm text-gray-500 mt-1">
                                    Student ID: {{ $user->student_id }}
                                </div>

                            @endif

                        </td>


                        {{-- Email --}}
                        <td class="p-4 text-gray-600">

                            {{ $user->email }}

                        </td>


                        {{-- Role --}}
                        <td class="p-4">

                            @if($user->role === 'Admin')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           font-semibold
                                           bg-red-100
                                           text-red-700">

                                    Admin

                                </span>

                            @elseif($user->role === 'Instructor')

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           font-semibold
                                           bg-purple-100
                                           text-purple-700">

                                    Instructor

                                </span>

                            @else

                                <span
                                    class="inline-flex
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           font-semibold
                                           bg-blue-100
                                           text-blue-700">

                                    Student

                                </span>

                            @endif

                        </td>


                        {{-- Status --}}
                        <td class="p-4">

                            @if($user->status === 'Active')

                                <span
                                    class="inline-flex
                                           items-center gap-1
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           font-semibold
                                           bg-green-100
                                           text-green-700">

                                    <span>●</span>
                                    Active

                                </span>

                            @else

                                <span
                                    class="inline-flex
                                           items-center gap-1
                                           px-3 py-1
                                           rounded-full
                                           text-xs
                                           font-semibold
                                           bg-red-100
                                           text-red-700">

                                    <span>●</span>
                                    Inactive

                                </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="p-4">

                            <div class="flex flex-wrap items-center gap-2">


                                {{-- View --}}
                                <a
                                    href="{{ route('users.show', $user) }}"
                                    class="text-blue-600
                                           hover:text-blue-800
                                           hover:underline
                                           font-medium">

                                    View

                                </a>


                                <span class="text-gray-300">
                                    |
                                </span>


                                {{-- Edit --}}
                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="text-green-600
                                           hover:text-green-800
                                           hover:underline
                                           font-medium">

                                    Edit

                                </a>


                                <span class="text-gray-300">
                                    |
                                </span>


                                {{-- Reset Password --}}
                                <a
                                    href="{{ route('users.password.edit', $user) }}"
                                    class="text-purple-600
                                           hover:text-purple-800
                                           hover:underline
                                           font-medium">

                                    Reset Password

                                </a>


                                <span class="text-gray-300">
                                    |
                                </span>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('users.destroy', $user) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600
                                               hover:text-red-800
                                               hover:underline
                                               font-medium"
                                        onclick="return confirm(
                                            'Are you sure you want to delete this user?'
                                        )">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="p-8 text-center text-gray-500">

                            No users found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="mt-5">

        {{ $users->appends(request()->query())->links() }}

    </div>

</div>

@endsection