```blade
@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-8">

    <div class="bg-white rounded-lg shadow p-8">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                User Profile
            </h1>

            <a
                href="{{ route('users.edit', $user) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

                Edit

            </a>

        </div>

        <div class="grid grid-cols-2 gap-6">

            {{-- Name --}}
            <div>

                <label class="font-semibold block mb-1">
                    Name
                </label>

                <p>{{ $user->name }}</p>

            </div>

            {{-- Email --}}
            <div>

                <label class="font-semibold block mb-1">
                    Email
                </label>

                <p>{{ $user->email }}</p>

            </div>

            {{-- Role --}}
            <div>

                <label class="font-semibold block mb-1">
                    Role
                </label>

                <p>{{ $user->role }}</p>

            </div>

            {{-- Student ID --}}
            <div>

                <label class="font-semibold block mb-1">
                    Student ID Number
                </label>

                @if($user->student_id)

                    <p>{{ $user->student_id }}</p>

                @else

                    <p class="text-gray-400">
                        Not applicable
                    </p>

                @endif

            </div>

            {{-- Department --}}
            <div>

                <label class="font-semibold block mb-1">
                    Department
                </label>

                <p>{{ $user->department ?? 'Not specified' }}</p>

            </div>

            {{-- Status --}}
            <div>

                <label class="font-semibold block mb-1">
                    Status
                </label>

                <p>{{ $user->status }}</p>

            </div>

            {{-- Created At --}}
            <div>

                <label class="font-semibold block mb-1">
                    Created At
                </label>

                <p>{{ $user->created_at }}</p>

            </div>

        </div>

    </div>

</div>

@endsection
```
