@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-8">

    <div class="bg-white rounded-lg shadow p-8">

        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">

                User Profile

            </h1>

            <a
                href="{{ route('users.edit',$user) }}"
                class="bg-yellow-500 text-white px-5 py-2 rounded">

                Edit

            </a>

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Name

                </label>

                <p>{{ $user->name }}</p>

            </div>

            <div>

                <label class="font-semibold">

                    Email

                </label>

                <p>{{ $user->email }}</p>

            </div>

            <div>

                <label class="font-semibold">

                    Role

                </label>

                <p>{{ $user->role }}</p>

            </div>

            <div>

                <label class="font-semibold">

                    Department

                </label>

                <p>{{ $user->department }}</p>

            </div>

            <div>

                <label class="font-semibold">

                    Status

                </label>

                <p>{{ $user->status }}</p>

            </div>

            <div>

                <label class="font-semibold">

                    Created At

                </label>

                <p>{{ $user->created_at }}</p>

            </div>

        </div>

    </div>

</div>

@endsection