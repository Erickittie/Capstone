@extends('layouts.admin')

@section('title', 'Bulk Registration Result')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        <a href="{{ route('admin.users.bulk-register') }}"
           class="inline-flex items-center text-sm
                  text-gray-500 hover:text-purple-600 mb-4">

            ← Back to Bulk Registration

        </a>

        <h1 class="text-3xl font-bold text-gray-800">
            Bulk Registration Result
        </h1>

        <p class="text-gray-500 mt-2">
            The CSV import has been processed.
        </p>

    </div>


    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        {{-- Successful --}}
        <div class="bg-white border border-gray-200
                    rounded-2xl p-6 shadow-sm">

            <div class="text-3xl mb-3">
                ✅
            </div>

            <p class="text-sm text-gray-500">
                Successfully Registered
            </p>

            <p class="text-4xl font-bold text-green-600 mt-2">
                {{ $successCount }}
            </p>

        </div>


        {{-- Skipped --}}
        <div class="bg-white border border-gray-200
                    rounded-2xl p-6 shadow-sm">

            <div class="text-3xl mb-3">
                ⚠️
            </div>

            <p class="text-sm text-gray-500">
                Skipped
            </p>

            <p class="text-4xl font-bold text-orange-500 mt-2">
                {{ $skippedCount }}
            </p>

        </div>


        {{-- Errors --}}
        <div class="bg-white border border-gray-200
                    rounded-2xl p-6 shadow-sm">

            <div class="text-3xl mb-3">
                ❌
            </div>

            <p class="text-sm text-gray-500">
                Errors
            </p>

            <p class="text-4xl font-bold text-red-600 mt-2">
                {{ count($errors) }}
            </p>

        </div>

    </div>


    {{-- Errors Table --}}
    @if(count($errors) > 0)

        <div class="bg-white border border-gray-200
                    rounded-2xl shadow-sm overflow-hidden">

            <div class="p-6 border-b border-gray-200">

                <h2 class="text-xl font-bold text-gray-800">
                    Import Issues
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    These rows were not registered.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-6 py-4">
                                Row
                            </th>

                            <th class="text-left px-6 py-4">
                                Name
                            </th>

                            <th class="text-left px-6 py-4">
                                Email
                            </th>

                            <th class="text-left px-6 py-4">
                                Problem
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($errors as $error)

                            <tr class="border-t border-gray-100">

                                <td class="px-6 py-4">
                                    {{ $error['row'] }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $error['name'] }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $error['email'] }}
                                </td>

                                <td class="px-6 py-4 text-red-600">

                                    @foreach($error['errors'] as $message)

                                        <div>
                                            {{ $message }}
                                        </div>

                                    @endforeach

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @else

        <div class="bg-green-50 border border-green-200
                    rounded-2xl p-8 text-center">

            <div class="text-5xl mb-4">
                🎉
            </div>

            <h2 class="text-xl font-bold text-green-800">
                All Users Were Registered Successfully!
            </h2>

            <p class="text-green-700 mt-2">
                There were no errors in the uploaded CSV.
            </p>

        </div>

    @endif


    {{-- Buttons --}}
    <div class="flex gap-3 mt-6">

        <a href="{{ route('admin.users.bulk-register') }}"
           class="px-5 py-3 rounded-xl
                  bg-purple-600 text-white
                  font-semibold hover:bg-purple-700">

            Import Another CSV

        </a>

        <a href="{{ url('/admin/users') }}"
           class="px-5 py-3 rounded-xl
                  border border-gray-300
                  text-gray-700 font-semibold
                  hover:bg-gray-50">

            View Users

        </a>

    </div>

</div>

@endsection