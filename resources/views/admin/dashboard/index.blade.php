@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                System Overview
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Monitor and manage academic users, classes, and system performance.
            </p>
        </div>
    </div>

    <!-- Stat Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card: Total Users -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Total Users
                </span>
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">group</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-black text-gray-900 tracking-tight">
                    {{ number_format($users) }}
                </p>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                    <span class="text-emerald-600 font-semibold">Active</span> across all roles
                </p>
            </div>
        </div>

        <!-- Card: Classes -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Classrooms
                </span>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">menu_book</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-black text-gray-900 tracking-tight">
                    {{ number_format($classes) }}
                </p>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                    <span class="text-sky-600 font-semibold">Configured</span> course sections
                </p>
            </div>
        </div>

        <!-- Card: Instructors -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Instructors
                </span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">school</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-black text-gray-900 tracking-tight">
                    {{ number_format($instructors) }}
                </p>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                    <span class="text-purple-600 font-semibold">Teaching</span> faculty members
                </p>
            </div>
        </div>

        <!-- Card: Reports -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                    Exports & Reports
                </span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">analytics</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-3xl font-black text-gray-900 tracking-tight">
                    {{ number_format($reports) }}
                </p>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                    <span class="text-amber-600 font-semibold">Generated</span> records
                </p>
            </div>
        </div>

    </div>

    <!-- Quick Navigation Hub -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('users.index') }}"
           class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:shadow-md hover:border-blue-300 transition duration-150 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-500 text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[26px]">manage_accounts</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                    User Management
                </h3>
                <p class="text-xs text-gray-500 mt-1">
                    Review and modify student, instructor, and admin credentials.
                </p>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 mt-3 group-hover:underline">
                    View users &rarr;
                </span>
            </div>
        </a>

        <a href="{{ route('classes.index') }}"
           class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:shadow-md hover:border-blue-300 transition duration-150 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-sky-600 text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[26px]">class</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                    Class Setup & Roster
                </h3>
                <p class="text-xs text-gray-500 mt-1">
                    Assign teachers, configure semesters, and import student rosters.
                </p>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 mt-3 group-hover:underline">
                    Manage classes &rarr;
                </span>
            </div>
        </a>

        <a href="{{ route('reports.index') }}"
           class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:shadow-md hover:border-blue-300 transition duration-150 flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[26px]">assessment</span>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                    Academic Analytics
                </h3>
                <p class="text-xs text-gray-500 mt-1">
                    Export enrollment metrics, group contribution, and completion summaries.
                </p>
                <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 mt-3 group-hover:underline">
                    Export reports &rarr;
                </span>
            </div>
        </a>

    </div>

</div>

@endsection