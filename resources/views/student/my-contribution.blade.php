<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Contribution - {{ $class->course_code }} - CarryOn</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .main-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .main-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-scroll::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 10px;
        }
    </style>
</head>

<body class="h-full text-gray-900 antialiased bg-[#F9FAFB] flex flex-col md:flex-row overflow-hidden">

    {{-- MOBILE HEADER --}}
    <div class="md:hidden flex items-center justify-between bg-[#FAF9FB] px-4 py-3 border-b border-gray-200 sticky top-0 z-40">
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
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    {{-- SIDEBAR --}}
    <aside
        id="sidebar"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB] border-r border-gray-200 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">

        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <img
                    src="{{ asset('images/carryon_logo_mark_v2.png') }}"
                    class="w-9 h-9 object-contain"
                    alt="CarryOn Logo">

                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">
                        CarryOn
                    </span>

                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">
                        Student Portal
                    </span>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">

            {{-- Dashboard --}}
            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all">
                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    grid_view
                </span>
                <span>Dashboard</span>
            </a>

            <div class="pt-4 pb-1.5">
                <p class="px-3.5 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                    My Work
                </p>
            </div>

            {{-- My Contribution --}}
            <a
                href="{{ route('student.my.contribution.class', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium">
                <span class="material-symbols-outlined text-[20px]">
                    person_check
                </span>
                <span>My Contribution</span>
            </a>

            {{-- Group Contribution --}}
            <a
                href="{{ route('student.contribution', $class->id) }}"
                class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all">
                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    groups
                </span>
                <span>Group Contribution</span>
            </a>

            {{-- Notifications --}}
            <a
                href="{{ route('student.notifications.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all">
                <span class="material-symbols-outlined text-[20px] text-gray-500">
                    notifications
                </span>
                <span>Notifications</span>
            </a>

        </nav>

        {{-- Logout --}}
        <div class="p-4 border-t border-gray-150">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all">
                    <span class="material-symbols-outlined text-[20px]">
                        logout
                    </span>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <div
        id="sidebar-overlay"
        class="fixed inset-0 bg-black/40 z-20 hidden md:hidden"
        onclick="toggleSidebar()">
    </div>

    {{-- MAIN --}}
    <main class="flex-1 overflow-y-auto main-scroll">

        {{-- HEADER --}}
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-5">
            <div class="max-w-7xl mx-auto">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-1">
                            <a
                                href="{{ route('student.class.detail', $class->id) }}"
                                class="hover:text-gray-700 transition-colors">
                                {{ $class->course_code }}
                            </a>

                            <span>/</span>

                            <span>My Contribution</span>
                        </div>

                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">
                            My Contribution
                        </h1>

                        <p class="text-sm text-gray-500 mt-0.5">
                            Your personal contribution for {{ $class->course_code }}.
                        </p>
                    </div>

                    <a
                        href="{{ route('student.class.detail', $class->id) }}"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-all">
                        <span class="material-symbols-outlined text-[18px]">
                            arrow_back
                        </span>
                        Back to Class
                    </a>

                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">

            {{-- CLASS INFORMATION --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="flex items-start gap-3">

                        <div class="w-11 h-11 rounded-lg bg-gray-900 text-white flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined">
                                school
                            </span>
                        </div>

                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">
                                Current Class
                            </p>

                            <h2 class="text-lg font-bold text-gray-900 mt-0.5">
                                {{ $class->course_code }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                {{ $class->course_name }}
                            </p>
                        </div>

                    </div>

                    @if($group)
                        <div class="text-left sm:text-right">
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                Your Group
                            </p>

                            <p class="text-sm font-semibold text-gray-800 mt-1">
                                {{ $group->name }}
                            </p>
                        </div>
                    @else
                        <span class="px-3 py-1.5 rounded-full bg-yellow-50 text-yellow-700 text-xs font-semibold">
                            No Group Assigned
                        </span>
                    @endif

                </div>

            </div>

            @if($group)

                {{-- CONTRIBUTION HERO --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6 lg:p-8 mb-6">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">

                        <div>

                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                Your Contribution Score
                            </p>

                            <div class="flex items-end gap-2 mt-1">
                                <span class="text-5xl font-bold tracking-tight text-gray-900">
                                    {{ number_format($contributionPercentage, 1) }}%
                                </span>
                            </div>

                            <p class="text-sm text-gray-500 mt-2">
                                Based on your approved task contribution within your group.
                            </p>

                            <div class="mt-5 w-full md:w-96">
                                <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div
                                        class="h-full bg-blue-600 rounded-full transition-all"
                                        style="width: {{ min(max($contributionPercentage, 0), 100) }}%">
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Circular score --}}
                        @php
                            $score = min(max($contributionPercentage, 0), 100);
                            $circumference = 263.9;
                            $offset = $circumference - ($circumference * $score / 100);
                        @endphp

                        <div class="relative w-32 h-32 flex-shrink-0 mx-auto md:mx-0">

                            <svg
                                class="w-full h-full -rotate-90"
                                viewBox="0 0 100 100">

                                <circle
                                    cx="50"
                                    cy="50"
                                    r="42"
                                    fill="none"
                                    stroke="#E5E7EB"
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
                                    stroke-dashoffset="{{ $offset }}"/>

                            </svg>

                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-xl font-bold text-gray-900">
                                    {{ number_format($contributionPercentage, 0) }}%
                                </span>

                                <span class="text-[10px] text-gray-400 uppercase tracking-wide">
                                    Contribution
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- STATISTICS --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                    {{-- Assigned --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <div class="w-9 h-9 rounded-lg bg-gray-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-gray-500 text-[20px]">
                                assignment
                            </span>
                        </div>

                        <p class="text-2xl font-bold text-gray-900 mt-4">
                            {{ $assignedTasks }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Assigned Tasks
                        </p>
                    </div>

                    {{-- Approved --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[20px]">
                                task_alt
                            </span>
                        </div>

                        <p class="text-2xl font-bold text-gray-900 mt-4">
                            {{ $completedTasks }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Approved Tasks
                        </p>
                    </div>

                    {{-- Submitted --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-amber-600 text-[20px]">
                                upload_file
                            </span>
                        </div>

                        <p class="text-2xl font-bold text-gray-900 mt-4">
                            {{ $submittedTasks }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Submitted Tasks
                        </p>
                    </div>

                    {{-- Pending --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-5">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-purple-600 text-[20px]">
                                pending
                            </span>
                        </div>

                        <p class="text-2xl font-bold text-gray-900 mt-4">
                            {{ $pendingTasks }}
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Pending Tasks
                        </p>
                    </div>

                </div>

                {{-- PROGRESS + POINTS --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                    {{-- Task Progress --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">

                        <div class="flex items-center justify-between mb-4">

                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Task Progress
                                </p>

                                <h3 class="text-lg font-bold text-gray-900 mt-1">
                                    {{ number_format($progressPercentage, 1) }}%
                                </h3>
                            </div>

                            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-emerald-600">
                                    trending_up
                                </span>
                            </div>

                        </div>

                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                            <div
                                class="h-full bg-emerald-500 rounded-full"
                                style="width: {{ min(max($progressPercentage, 0), 100) }}%">
                            </div>
                        </div>

                        <p class="text-xs text-gray-400 mt-3">
                            {{ $completedTasks }} of {{ $assignedTasks }} assigned tasks are approved.
                        </p>

                    </div>

                    {{-- Points --}}
                    <div class="bg-white rounded-xl border border-gray-200 p-6">

                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                                    Contribution Points
                                </p>

                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-3xl font-bold text-gray-900">
                                        {{ number_format($myPoints, 1) }}
                                    </span>

                                    <span class="text-sm text-gray-400">
                                        points
                                    </span>
                                </div>
                            </div>

                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-blue-600">
                                    stars
                                </span>
                            </div>

                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">

                            <span class="text-xs text-gray-400">
                                Group approved points
                            </span>

                            <span class="text-sm font-semibold text-gray-700">
                                {{ number_format($groupPoints, 1) }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- INFORMATION --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">

                    <div class="flex items-start gap-3">

                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-blue-600 text-[20px]">
                                info
                            </span>
                        </div>

                        <div>

                            <h3 class="font-semibold text-gray-900">
                                How your contribution is calculated
                            </h3>

                            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                                Your contribution points come from tasks that have an approved
                                assignment for you. When multiple group members are approved
                                for the same task, the task points are divided among those
                                approved members. Your contribution percentage is based on
                                your earned points compared with the approved group task points
                                for this class.
                            </p>

                        </div>

                    </div>

                </div>

            @else

                {{-- NO GROUP --}}
                <div class="bg-white rounded-xl border border-dashed border-gray-300 p-12 text-center">

                    <div class="w-16 h-16 rounded-full bg-yellow-50 mx-auto flex items-center justify-center">
                        <span class="material-symbols-outlined text-yellow-600 text-[30px]">
                            groups
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mt-5">
                        No Group Assigned
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                        You are enrolled in this class, but you have not been assigned
                        to a group yet. Your contribution score will appear once your
                        group and tasks are available.
                    </p>

                </div>

            @endif

        </div>

        {{-- FOOTER --}}
        <footer class="px-6 lg:px-10 py-6 border-t border-gray-100 mt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 max-w-7xl mx-auto">

                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">
                    CarryOn Academic Systems
                </span>

                <span class="text-xs text-gray-400">
                    © 2026 CarryOn Academic Systems.
                </span>

            </div>
        </footer>

    </main>

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
