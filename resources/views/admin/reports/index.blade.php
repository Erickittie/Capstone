@extends('layouts.admin')

@section('content')

<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Analytics & Reports
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Generate and export class metrics, student contribution fairness, and project completion reports.
        </p>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
            <span class="material-symbols-outlined text-emerald-600 text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Generate Report Cards -->
    <div>
        <h2 class="text-base font-bold text-gray-900 mb-4">
            Generate Report
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1: Enrollment -->
            <div class="bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md transition duration-150 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">
                            group
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">
                        Enrollment Summary
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Overview of student enrollment breakdown by classroom, term, and department.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('reports.enrollment') }}"
                       class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 text-xs font-semibold text-gray-700 shadow-2xs transition">
                        Generate Report
                    </a>
                </div>
            </div>

            <!-- Card 2: Contribution Fairness -->
            <div class="bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md transition duration-150 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">
                            balance
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">
                        Contribution Fairness
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Distribution of peer evaluation and commit contribution scores across student groups.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('reports.contribution') }}"
                       class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 text-xs font-semibold text-gray-700 shadow-2xs transition">
                        Generate Report
                    </a>
                </div>
            </div>

            <!-- Card 3: Completion Trends -->
            <div class="bg-white border border-gray-200/80 rounded-2xl p-6 shadow-xs hover:shadow-md transition duration-150 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">
                            trending_up
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">
                        Completion Trends
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Milestone and task completion rates over time organized by semester and class.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('reports.completion') }}"
                       class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 hover:border-gray-300 text-xs font-semibold text-gray-700 shadow-2xs transition">
                        Generate Report
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Recent Exports Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-gray-900">
                    Recent Exports
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    Previously generated downloadable spreadsheets and PDFs.
                </p>
            </div>
            <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                {{ $reports->count() }} records
            </span>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-xs overflow-hidden">
            @forelse($reports as $report)
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 last:border-b-0 hover:bg-gray-50/70 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-[20px]">
                                description
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 leading-tight">
                                {{ $report['filename'] }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Generated {{ $report['date'] }} &bull; {{ $report['size'] }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('reports.download', $report['filename']) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition">
                        <span class="material-symbols-outlined text-[16px]">download</span>
                        <span>Download</span>
                    </a>
                </div>
            @empty
                <div class="py-12 text-center text-gray-400">
                    <span class="material-symbols-outlined text-[36px] text-gray-300 block mb-2">
                        analytics
                    </span>
                    <h3 class="text-sm font-semibold text-gray-700">
                        No reports generated yet
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">
                        Use the generator options above to produce academic exports.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
            
