@extends('layouts.admin')

@section('content')

<div class ="max-w-7xl mx-auto">
    <div class ="flex items-center justify-between mb-8">
        <div>
            <p class="text-sm font-medium text-blue-600 uppercase tracking-wide">
                Analytics & Reporting
            </p>
            <h1 class="text-3xl font-bold text-gray-900 mt-1">
                Reports
            </h1>

            <p class="text-gray-500 mt-2">
                Generate academic reports and review previous exports.
            </p>
        </div>
    </div>
    
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-5 py-4">
            {{ session('success')}}
        </div>
    @endif
    
    <div class="mb-10">
        <h2 class ="text-xl font-semibold text-gray-900 mb-5">
            Generate a report
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mb-5">
                    <span class="text-2xl">
                         👥
                    </span>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900">
                    Enrollment Summary
                </h3>
                <p class="text-sm text-gray-500 mt-2 min-h-[48px]">
                    Student and enrollment by class, term, and department.
                </p>
                <a href="{{ route('reports.enrollment') }}"
                class="inline-flex items-center justify-center mt-5 px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-green-700 transition">
                Generate
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-5">
                    <span class="text-2xl">
                        ⚖️
                    </span>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900">
                    Contribution Fairness
                </h3>
                
                <p class="text-sm text-gray-500 mt-2 min-h-[48px]">
                    Distribution of contribution scores across all groups.
                </p>
                
                <a href="{{ route('reports.contribution') }}"
                class="inline-flex items-center justify-center mt-5 px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-green-700 transition">
                Generate
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 roundel-lg flex items-center justify-center mb-5">
                    <span class="text-2xl">
                          📈
                    </span>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900">
                    Completion Trends
                </h3>
                
                <p class="text-sm text-gray-500 mt-2 min-h-[48px]">
                    Task completion rates over time, organized by class.
                </p>
                
                <a href="{{ route('reports.completion') }}"
                class="inline-flex items-center justify-center mt-5 px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-green-50 hover:border-green-300 hover:text-green-700 transition">
                Generate
                </a>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Recent exports
                </h2>

                 <p class="text-sm text-gray-500 mt-1">
                    Previously generated reports.
                </p>
            </div>

            <span class="text-sm text-gray-500">
                {{ $reports->count() }} reports
            </span>

            </div>

            <div class="bg-white border border-gray-200
                    rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200">

                <h3 class="text-lg font-semibold text-gray-900">
                    Generated reports
                </h3>
            </div>

             @forelse($reports as $report)

                <div class="flex items-center justify-between
                            px-6 py-5
                            border-b border-gray-100
                            last:border-b-0
                            hover:bg-gray-50 transition">

                <div class="flex items-center gap-4">

                        <div class="w-10 h-10 bg-gray-100
                                    rounded-lg
                                    flex items-center justify-center">

                            <span>
                                📄
                            </span>

                        </div>


                        <div>

                        <p class="font-medium text-gray-900">
                                {{ $report['filename'] }}
                            </p>

                            <p class="text-sm text-gray-500 mt-1">

                                Generated
                                {{ $report['date'] }}

                                ·

                                {{ $report['size'] }}

                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ route('reports.download', $report['filename']) }}"
                        class="px-5 py-2.5
                               border border-gray-300
                               rounded-lg
                               text-sm font-medium
                               text-gray-700
                               hover:bg-blue-50
                               hover:text-blue-700
                               hover:border-blue-300
                               transition">

                        Download

                    </a>

                </div>

             @empty

                <div class="px-6 py-12 text-center">

                    <div class="text-4xl mb-3">
                        📊
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        No reports yet
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Generate your first report above.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
            
