@extends('layouts.student')

@section('title', 'Student Dashboard - CarryOn')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Welcome back, {{ auth()->user()->name ?? 'Student' }}</p>
    </div>

    <!-- Quick Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600 text-[22px]">monitoring</span>
            </div>
            <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Avg. Contribution</p>
                <p class="text-2xl font-bold text-gray-900">87<span class="text-sm font-medium text-gray-400">%</span></p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-amber-600 text-[22px]">assignment</span>
            </div>
            <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Active Tasks</p>
                <p class="text-2xl font-bold text-gray-900">12</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-indigo-600 text-[22px]">event_available</span>
            </div>
            <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Check-In Pending</p>
                <p class="text-2xl font-bold text-gray-900">1</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-green-600 text-[22px]">menu_book</span>
            </div>
            <div>
                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Classes</p>
                <p class="text-2xl font-bold text-gray-900">3</p>
            </div>
        </div>
    </div>

    <!-- My Enrolled Classes -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-base font-bold text-gray-900">My Enrolled Classes</h2>
                <p class="text-sm text-gray-500 mt-0.5">Select a class to view your groups and contributions</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Class Card 1 -->
            <a href="/student/class/cs402" class="group block bg-white rounded-2xl border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">
                <div class="h-2 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 text-[22px]">dns</span>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Active</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors">CS402: Distributed Systems</h3>
                    <p class="text-xs text-gray-500 mt-1 mb-4">Prof. Dr. Santos · MWF 10:00 AM</p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">group</span>
                                <span>3 Groups</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">assignment</span>
                                <span>5 Tasks</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[18px]">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- Class Card 2 -->
            <a href="/student/class/psy310" class="group block bg-white rounded-2xl border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">
                <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[22px]">psychology</span>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Active</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm group-hover:text-emerald-600 transition-colors">PSY310: Cognitive Architecture</h3>
                    <p class="text-xs text-gray-500 mt-1 mb-4">Prof. Reyes · TTh 1:30 PM</p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">group</span>
                                <span>2 Groups</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">assignment</span>
                                <span>3 Tasks</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[18px]">arrow_forward</span>
                    </div>
                </div>
            </a>

            <!-- Class Card 3 -->
            <a href="/student/class/art205" class="group block bg-white rounded-2xl border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden">
                <div class="h-2 bg-gradient-to-r from-violet-500 to-purple-500"></div>
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-violet-600 text-[22px]">palette</span>
                        </div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-600 bg-violet-50 px-2.5 py-1 rounded-full">Active</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm group-hover:text-violet-600 transition-colors">ART205: Digital Ethics</h3>
                    <p class="text-xs text-gray-500 mt-1 mb-4">Prof. Garcia · MWF 2:00 PM</p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">group</span>
                                <span>4 Groups</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-[14px]">assignment</span>
                                <span>4 Tasks</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[18px]">arrow_forward</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div>
        <h2 class="text-base font-bold text-gray-900 mb-4">Recent Activity</h2>
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs divide-y divide-gray-100">
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-9 h-9 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">Task "API Documentation" approved by PM</p>
                    <p class="text-xs text-gray-400">CS402 · Group Alpha · 2 hours ago</p>
                </div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-green-700 bg-green-50 px-2.5 py-1 rounded-full border border-green-100">Approved</span>
            </div>
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-blue-600 text-[18px]">how_to_vote</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">Leader vote started for Group Beta</p>
                    <p class="text-xs text-gray-400">PSY310 · 5 hours ago</p>
                </div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-100">Vote Open</span>
            </div>
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-9 h-9 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-amber-600 text-[18px]">upload_file</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">Maria uploaded "Research_Notes_v2.pdf"</p>
                    <p class="text-xs text-gray-400">ART205 · Group Delta · Yesterday</p>
                </div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-100">File Added</span>
            </div>
            <div class="flex items-center gap-4 px-5 py-4">
                <div class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-red-600 text-[18px]">undo</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">Task "Database Schema" returned for revision</p>
                    <p class="text-xs text-gray-400">CS402 · Group Alpha · Yesterday</p>
                </div>
                <span class="text-[10px] font-semibold uppercase tracking-wider text-red-700 bg-red-50 px-2.5 py-1 rounded-full border border-red-100">Revision</span>
            </div>
        </div>
    </div>

</div>

@endsection