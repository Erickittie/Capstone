<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="h-full bg-[#FAF9FB]">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Contribution Score - {{ $class->course_code }} - CarryOn
    </title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">

    <script src="{{ asset('js/tailwind-config.js') }}"></script>

    <link href="{{ asset('css/student-pages.css') }}" rel="stylesheet">

</head>


<body class="h-full text-gray-900 antialiased font-sans bg-[#F9FAFB] flex flex-col md:flex-row overflow-hidden">


    {{-- ========================================================= --}}
    {{-- MOBILE MENU --}}
    {{-- ========================================================= --}}

    <div class="md:hidden flex items-center justify-between bg-[#FAF9FB]
                px-4 py-3 border-b border-gray-200 sticky top-0 z-40">

        <div class="flex items-center gap-2.5">

            <img
                src="{{ asset('images/carryon_logo_mark_v2.png') }}"
                class="w-8 h-8 object-contain"
                alt="CarryOn Logo">

            <span class="font-bold text-base tracking-tight text-gray-900">
                CarryOn
            </span>

        </div>

        <button
            id="mobile-menu-toggle"
            class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">

            <span class="material-symbols-outlined">
                menu
            </span>

        </button>

    </div>


    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside
        id="sidebar"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB]
               border-r border-gray-200 flex flex-col
               transform -translate-x-full md:translate-x-0
               md:static transition-transform duration-300 ease-in-out">


        {{-- Logo --}}

        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">

            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3">

                <img
                    src="{{ asset('images/carryon_logo_mark_v2.png') }}"
                    class="w-9 h-9 object-contain"
                    alt="CarryOn Logo">

                <div>

                    <span class="font-bold text-lg tracking-tight
                                 text-gray-900 block">
                        CarryOn
                    </span>

                    <span class="text-[10px] uppercase tracking-widest
                                 text-gray-400 font-semibold block -mt-1">
                        Student Portal
                    </span>

                </div>

            </a>

        </div>


        {{-- Navigation --}}

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">

            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium transition-all">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    grid_view
                </span>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- Current Class --}}

            <div class="pt-3 pb-1.5">

                <p class="px-3.5 text-[10px] uppercase
                          tracking-widest text-gray-400 font-semibold">

                    {{ $class->course_code }}

                </p>

            </div>


            {{-- Class Overview --}}

            <a
                href="{{ route('student.class.detail', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium transition-all">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    class
                </span>

                <span>
                    Class Overview
                </span>

            </a>


            {{-- Contribution --}}

            <a
                href="{{ route('student.contribution', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       bg-gray-900 text-white rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px]">
                    monitoring
                </span>

                <span>
                    Contribution
                </span>

            </a>


            {{-- Group Status --}}

            <a
                href="{{ route('student.group.status', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    groups
                </span>

                <span>
                    Group Status
                </span>

            </a>


            {{-- Leader Vote --}}

            <a
                href="{{ route('student.vote.index', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    how_to_vote
                </span>

                <span>
                    Leader Vote
                </span>

            </a>


            {{-- Task Manager --}}

            <a
                href="{{ route('student.task.manager', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    assignment
                </span>

                <span>
                    Task Manager
                </span>

            </a>


            {{-- File Repository --}}

            <a
                href="{{ route('student.file.repository', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    folder_open
                </span>

                <span>
                    File Repository
                </span>

            </a>


            {{-- Check In --}}

            <a
                href="{{ route('student.checkin.index', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5
                       text-gray-600 hover:text-gray-900
                       hover:bg-gray-50 rounded-lg
                       text-[14px] font-medium pl-9">

                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    event_available
                </span>

                <span>
                    Check-In Request
                </span>

            </a>

        </nav>


        {{-- Logout --}}

        <div class="p-4 border-t border-gray-150">

            <form method="POST" action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3
                           px-3.5 py-2.5 text-gray-600
                           hover:text-red-600 hover:bg-red-50
                           rounded-lg text-[14px] font-medium
                           transition-all">

                    <span class="material-symbols-outlined text-[20px]">
                        logout
                    </span>

                    <span>
                        Log Out
                    </span>

                </button>

            </form>

        </div>

    </aside>


    <div
        id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 z-20 hidden md:hidden"
        onclick="toggleSidebar()">
    </div>


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}

    <main class="flex-1 overflow-y-auto main-scroll">


        {{-- Header --}}

        <header
            class="sticky top-0 z-10 bg-white/80 backdrop-blur-md
                   border-b border-gray-100
                   px-6 lg:px-10 py-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('student.class.detail', $class->id) }}"
                        class="text-gray-400 hover:text-gray-900 transition-colors">

                        <span class="material-symbols-outlined text-[20px]">
                            arrow_back
                        </span>

                    </a>

                    <div>

                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">
                            Contribution Score
                        </h1>

                        <p class="text-sm text-gray-500 mt-0.5">

                            {{ $class->course_code }}:
                            {{ $class->course_name }}

                            ·

                            {{ $group->name }}

                        </p>

                    </div>

                </div>

            </div>

        </header>


        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">


            {{-- ========================================================= --}}
            {{-- SCORE SUMMARY --}}
            {{-- ========================================================= --}}

            @php

                $currentStudent = $members->firstWhere('id', auth()->id());

                $myContribution = $currentStudent
                    ? $currentStudent->contribution_percentage
                    : 0;

                $myProgress = $currentStudent
                    ? $currentStudent->progress
                    : 0;

            @endphp


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">


                {{-- My Contribution --}}

                <div
                    class="bg-white rounded-xl border border-gray-200
                           p-8 flex flex-col items-center justify-center">

                    <p class="text-[10px] uppercase tracking-wider
                              text-gray-400 font-semibold mb-4">

                        Your Contribution

                    </p>


                    <div class="relative w-44 h-44 mb-4">

                        <svg
                            class="w-full h-full -rotate-90"
                            viewBox="0 0 100 100">

                            <circle
                                cx="50"
                                cy="50"
                                r="42"
                                fill="none"
                                stroke="#F3F4F6"
                                stroke-width="8"/>

                            <circle
                                cx="50"
                                cy="50"
                                r="42"
                                fill="none"
                                stroke="#2563EB"
                                stroke-width="8"
                                stroke-linecap="round"
                                stroke-dasharray="263.9"
                                stroke-dashoffset="{{ 263.9 - (263.9 * $myContribution / 100) }}"/>

                        </svg>


                        <div
                            class="absolute inset-0 flex flex-col
                                   items-center justify-center">

                            <span class="text-4xl font-bold text-gray-900">

                                {{ number_format($myContribution, 1) }}%

                            </span>

                            <span class="text-sm text-gray-400">
                                contribution
                            </span>

                        </div>

                    </div>


                    <div class="flex items-center gap-1.5 text-sm">

                        <span
                            class="material-symbols-outlined
                                   text-blue-500 text-[18px]">

                            monitoring

                        </span>

                        <span class="font-semibold text-blue-600">

                            {{ number_format($myContribution, 1) }}%

                        </span>

                        <span class="text-gray-400">
                            of group contribution
                        </span>

                    </div>

                </div>


                {{-- Progress --}}

                <div
                    class="bg-white rounded-xl border border-gray-200
                           p-6 lg:col-span-2">

                    <h3 class="font-bold text-gray-900 mb-1">
                        Your Progress
                    </h3>

                    <p class="text-sm text-gray-500 mb-6">
                        Your current task completion progress
                    </p>


                    <div class="space-y-6">


                        {{-- Progress --}}

                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <div class="flex items-center gap-2">

                                    <span
                                        class="material-symbols-outlined
                                               text-blue-600 text-[18px]">

                                        check_circle

                                    </span>

                                    <span class="text-sm font-medium text-gray-700">
                                        Task Progress
                                    </span>

                                </div>

                                <span class="text-sm font-bold text-gray-900">

                                    {{ number_format($myProgress, 1) }}%

                                </span>

                            </div>


                            <div
                                class="w-full h-2.5 bg-gray-100
                                       rounded-full overflow-hidden">

                                <div
                                    class="h-full bg-blue-600 rounded-full"
                                    style="width: {{ min($myProgress, 100) }}%">
                                </div>

                            </div>


                            <p class="text-xs text-gray-400 mt-2">

                                {{ $currentStudent->completed_tasks ?? 0 }}

                                of

                                {{ $currentStudent->assigned_tasks ?? 0 }}

                                assigned tasks completed

                            </p>

                        </div>


                        {{-- Group Progress --}}

                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <div class="flex items-center gap-2">

                                    <span
                                        class="material-symbols-outlined
                                               text-emerald-600 text-[18px]">

                                        groups

                                    </span>

                                    <span class="text-sm font-medium text-gray-700">
                                        Group Progress
                                    </span>

                                </div>

                                <span class="text-sm font-bold text-gray-900">

                                    {{ number_format($groupProgress, 1) }}%

                                </span>

                            </div>


                            <div
                                class="w-full h-2.5 bg-gray-100
                                       rounded-full overflow-hidden">

                                <div
                                    class="h-full bg-emerald-500 rounded-full"
                                    style="width: {{ min($groupProgress, 100) }}%">
                                </div>

                            </div>


                            <p class="text-xs text-gray-400 mt-2">

                                {{ $tasks->count() }}

                                total group tasks

                            </p>

                        </div>


                        {{-- Contribution Points --}}

                        <div
                            class="flex items-center justify-between
                                   bg-gray-50 rounded-lg p-4">

                            <div>

                                <p class="text-sm font-medium text-gray-700">
                                    Your Contribution Points
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Based on approved task assignments
                                </p>

                            </div>

                            <span class="text-xl font-bold text-gray-900">

                                {{ number_format($currentStudent->contribution_points ?? 0, 1) }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- GROUP MEMBERS --}}
            {{-- ========================================================= --}}

            <div
                class="bg-white rounded-xl border border-gray-200
                       p-6 mb-8">

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-3 mb-6">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            Group Members
                        </h3>

                        <p class="text-sm text-gray-500 mt-0.5">
                            View each member's contribution and progress
                        </p>

                    </div>


                    <div
                        class="px-3 py-1.5 bg-gray-100
                               rounded-lg text-sm text-gray-600">

                        {{ $members->count() }} members

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr
                                class="border-b border-gray-100
                                       text-left">

                                <th
                                    class="pb-3 text-xs uppercase
                                           tracking-wider text-gray-400
                                           font-semibold">

                                    Member

                                </th>

                                <th
                                    class="pb-3 text-xs uppercase
                                           tracking-wider text-gray-400
                                           font-semibold">

                                    Tasks

                                </th>

                                <th
                                    class="pb-3 text-xs uppercase
                                           tracking-wider text-gray-400
                                           font-semibold">

                                    Progress

                                </th>

                                <th
                                    class="pb-3 text-xs uppercase
                                           tracking-wider text-gray-400
                                           font-semibold">

                                    Contribution

                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($members as $member)

                                <tr class="hover:bg-gray-50 transition">


                                    {{-- Member --}}

                                    <td class="py-5">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-full
                                                       bg-gray-900 text-white
                                                       flex items-center
                                                       justify-center
                                                       font-semibold">

                                                {{ strtoupper(substr($member->name, 0, 1)) }}

                                            </div>


                                            <div>

                                                <div
                                                    class="font-semibold
                                                           text-gray-900">

                                                    {{ $member->name }}

                                                    @if($member->is_leader)

                                                        <span
                                                            class="ml-2 inline-flex
                                                                   items-center
                                                                   px-2 py-0.5
                                                                   rounded-full
                                                                   bg-blue-50
                                                                   text-blue-600
                                                                   text-[10px]
                                                                   font-semibold">

                                                            LEADER

                                                        </span>

                                                    @endif

                                                </div>

                                                @if($member->id == auth()->id())

                                                    <span
                                                        class="text-xs
                                                               text-gray-400">

                                                        You

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Tasks --}}

                                    <td class="py-5">

                                        <span
                                            class="text-sm font-medium
                                                   text-gray-700">

                                            {{ $member->completed_tasks }}

                                        </span>

                                        <span class="text-sm text-gray-400">
                                            /
                                            {{ $member->assigned_tasks }}
                                        </span>

                                    </td>


                                    {{-- Progress --}}

                                    <td class="py-5 min-w-[180px]">

                                        <div
                                            class="flex items-center
                                                   justify-between mb-1.5">

                                            <span
                                                class="text-sm font-semibold
                                                       text-gray-700">

                                                {{ number_format($member->progress, 1) }}%

                                            </span>

                                        </div>


                                        <div
                                            class="w-full h-2
                                                   bg-gray-100 rounded-full
                                                   overflow-hidden">

                                            <div
                                                class="h-full bg-blue-600
                                                       rounded-full transition-all"
                                                style="width: {{ min($member->progress, 100) }}%">
                                            </div>

                                        </div>

                                    </td>


                                    {{-- Contribution --}}

                                    <td class="py-5 min-w-[180px]">

                                        <div
                                            class="flex items-center
                                                   justify-between mb-1.5">

                                            <span
                                                class="text-sm font-bold
                                                       text-gray-900">

                                                {{ number_format($member->contribution_percentage, 1) }}%

                                            </span>

                                        </div>


                                        <div
                                            class="w-full h-2
                                                   bg-gray-100 rounded-full
                                                   overflow-hidden">

                                            <div
                                                class="h-full bg-emerald-500
                                                       rounded-full transition-all"
                                                style="width: {{ min($member->contribution_percentage, 100) }}%">
                                            </div>

                                        </div>


                                        <p class="text-xs text-gray-400 mt-1">

                                            {{ number_format($member->contribution_points, 1) }}
                                            points

                                        </p>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="4"
                                        class="py-12 text-center">

                                        <span
                                            class="material-symbols-outlined
                                                   text-gray-300 text-5xl">

                                            groups

                                        </span>

                                        <p
                                            class="text-gray-500 mt-3">

                                            No group members found.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- GROUP SUMMARY --}}
            {{-- ========================================================= --}}

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Group Progress --}}

                <div
                    class="bg-white rounded-xl border border-gray-200 p-6">

                    <div class="flex items-center gap-3 mb-5">

                        <div
                            class="w-10 h-10 rounded-lg
                                   bg-emerald-50
                                   flex items-center justify-center">

                            <span
                                class="material-symbols-outlined
                                       text-emerald-600">

                                groups

                            </span>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-900">
                                Group Progress
                            </h3>

                            <p class="text-xs text-gray-400">
                                Overall task completion
                            </p>

                        </div>

                    </div>


                    <div class="flex items-end gap-2">

                        <span class="text-4xl font-bold text-gray-900">

                            {{ number_format($groupProgress, 1) }}%

                        </span>

                        <span class="text-sm text-gray-400 mb-1">
                            completed
                        </span>

                    </div>


                    <div
                        class="w-full h-3 bg-gray-100 rounded-full
                               overflow-hidden mt-4">

                        <div
                            class="h-full bg-emerald-500 rounded-full"
                            style="width: {{ min($groupProgress, 100) }}%">
                        </div>

                    </div>

                </div>


                {{-- Contribution Points --}}

                <div
                    class="bg-white rounded-xl border border-gray-200 p-6">

                    <div class="flex items-center gap-3 mb-5">

                        <div
                            class="w-10 h-10 rounded-lg
                                   bg-blue-50
                                   flex items-center justify-center">

                            <span
                                class="material-symbols-outlined
                                       text-blue-600">

                                monitoring

                            </span>

                        </div>

                        <div>

                            <h3 class="font-bold text-gray-900">
                                Group Contribution
                            </h3>

                            <p class="text-xs text-gray-400">
                                Total approved contribution points
                            </p>

                        </div>

                    </div>


                    <span class="text-4xl font-bold text-gray-900">

                        {{ number_format($totalContributionPoints, 1) }}

                    </span>

                    <span class="text-sm text-gray-400 ml-1">
                        points
                    </span>


                    <p class="text-sm text-gray-500 mt-4">

                        Based on approved task assignments from
                        all group members.

                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <footer
            class="px-6 lg:px-10 py-6
                   border-t border-gray-100 mt-8">

            <div
                class="flex flex-col sm:flex-row
                       justify-between items-center gap-3
                       max-w-7xl mx-auto">

                <span
                    class="text-[10px] uppercase tracking-widest
                           text-gray-400 font-semibold">

                    CarryOn Academic Systems

                </span>

                <span class="text-xs text-gray-400">

                    © 2024 CarryOn Academic Systems.

                </span>

            </div>

        </footer>

    </main>


    {{-- ========================================================= --}}
    {{-- MOBILE SIDEBAR SCRIPT --}}
    {{-- ========================================================= --}}

    <script>

        function toggleSidebar() {

            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');

        }


        document
            .getElementById('mobile-menu-toggle')
            ?.addEventListener('click', toggleSidebar);

    </script>

</body>

</html>