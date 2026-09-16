@extends('layouts.admin')

@section('title', 'Bulk User Registration')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">

        {{-- Back to Users --}}
        <a href="{{ route('users.index') }}"
           class="inline-flex items-center text-sm
                  text-gray-500 hover:text-purple-600
                  mb-4 transition">

            ← Back to Users

        </a>

        <h1 class="text-3xl font-bold text-gray-800">
            Bulk User Registration
        </h1>

        <p class="text-gray-500 mt-2">
            Register multiple students and instructors using a CSV file.
        </p>

    </div>


    {{-- Upload Card --}}
    <div class="bg-white border border-gray-200
                rounded-2xl shadow-sm p-8">

        {{-- Title --}}
        <div class="flex items-start gap-4 mb-6">

            <div class="text-4xl">
                📥
            </div>

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Upload CSV File
                </h2>

                <p class="text-gray-500 mt-1">
                    Use the CarryOn CSV format to register users.
                </p>

            </div>

        </div>


        {{-- Session Error --}}
        @if(session('error'))

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 rounded-xl p-4">

                {{ session('error') }}

            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 rounded-xl p-4">

                <ul class="list-disc list-inside space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- CSV Format --}}
        <div class="bg-gray-50 border border-gray-200
                    rounded-xl p-5 mb-6">

            <h3 class="font-semibold text-gray-800">
                CSV Columns
            </h3>

            <div class="overflow-x-auto mt-4">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="border-b border-gray-200">

                            <th class="text-left py-3 px-3">
                                student_id
                            </th>

                            <th class="text-left py-3 px-3">
                                name
                            </th>

                            <th class="text-left py-3 px-3">
                                email
                            </th>

                            <th class="text-left py-3 px-3">
                                role
                            </th>

                            <th class="text-left py-3 px-3">
                                department
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td class="py-3 px-3">
                                2022008683
                            </td>

                            <td class="py-3 px-3">
                                Jer Erick Dumalagan
                            </td>

                            <td class="py-3 px-3">
                                jererick@example.com
                            </td>

                            <td class="py-3 px-3">
                                Student
                            </td>

                            <td class="py-3 px-3">
                                SCS
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Default Password Information --}}
        <div class="bg-blue-50 border border-blue-200
                    rounded-xl p-5 mb-6">

            <h3 class="font-semibold text-blue-800">
                Default Password
            </h3>

            <p class="text-sm text-blue-700 mt-2">
                Student accounts will use their
                <strong>Student ID</strong> as the initial password.
            </p>

            <p class="text-sm text-blue-700 mt-1">
                Instructor accounts will use
                <strong>CarryOn@123</strong> as the initial password.
            </p>

        </div>


        {{-- Upload Form --}}
        <form
            action="{{ route('admin.users.bulk-register.import') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            {{-- CSV File --}}
            <div>

                <label
                    class="block text-sm font-semibold
                           text-gray-700 mb-2">

                    Select CSV File

                </label>

                <input
                    type="file"
                    name="csv_file"
                    accept=".csv,.txt"
                    required
                    class="w-full border border-gray-300
                           rounded-xl px-4 py-3
                           bg-white
                           focus:outline-none
                           focus:ring-2
                           focus:ring-purple-500">

                <p class="text-sm text-gray-500 mt-2">
                    Accepted file types: CSV or TXT.
                </p>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-wrap gap-3 mt-6">

                {{-- Download Template --}}
                <a
                    href="{{ route('admin.users.bulk-register.template') }}"
                    class="px-5 py-3 rounded-xl
                           border border-gray-300
                           text-gray-700 font-semibold
                           hover:bg-gray-50
                           transition">

                    📄 Download CSV Template

                </a>


                {{-- Upload --}}
                <button
                    type="submit"
                    class="px-5 py-3 rounded-xl
                           bg-purple-600 text-white
                           font-semibold
                           hover:bg-purple-700
                           transition">

                    📥 Upload & Register Users

                </button>

            </div>

        </form>

    </div>

</div>

@endsection