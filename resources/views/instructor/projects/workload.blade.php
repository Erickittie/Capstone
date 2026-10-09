@extends('layouts.instructor')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('instructor.projects.index', $class->id) }}"
           class="text-sm text-purple-600 hover:text-purple-700">
            ← Back to Projects
        </a>

        <h1 class="text-3xl font-bold text-gray-900 mt-4">
            Workload Imbalance Report
        </h1>

        <p class="text-gray-500 mt-2">
            {{ $project->title }}
        </p>

        <div class="mt-4 inline-flex items-center gap-2 px-4 py-2
                    rounded-xl bg-purple-50 border border-purple-100">
            <span class="text-sm text-gray-600">
                Minimum contribution threshold:
            </span>

            <span class="font-bold text-purple-700">
                {{ number_format($threshold, 2) }}%
            </span>
        </div>
    </div>

    {{-- Explanation --}}
    <div class="mb-8 p-5 rounded-xl bg-blue-50 border border-blue-100">
        <h2 class="font-semibold text-blue-900">
            How this report works
        </h2>

        <p class="text-sm text-blue-800 mt-2">
            Contribution is calculated from approved task points within
            each group. Members below the project's minimum threshold
            are flagged for instructor review. A flag indicates a
            possible imbalance, not automatic proof of poor performance.
        </p>
    </div>

    {{-- Group Reports --}}
    @forelse($reports as $report)

        <div class="bg-white border border-gray-200 rounded-2xl
                    shadow-sm mb-8 overflow-hidden">

            {{-- Group Header --}}
            <div class="p-6 border-b border-gray-200
                        flex flex-col md:flex-row
                        md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $report['group']->name }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $report['members']->count() }} member(s)
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 text-sm">
                    <span class="px-3 py-2 rounded-lg bg-gray-100
                                 text-gray-700">
                        Approved points:
                        <strong>
                            {{ $report['total_approved_points'] }}
                        </strong>
                    </span>

                    <span class="px-3 py-2 rounded-lg
                                 {{ $report['flagged_count'] > 0
                                    ? 'bg-red-50 text-red-700'
                                    : 'bg-green-50 text-green-700' }}">
                        Flagged:
                        <strong>{{ $report['flagged_count'] }}</strong>
                    </span>
                </div>
            </div>

            {{-- Not Enough Work --}}
            @unless($report['has_enough_work'])
                <div class="m-6 p-4 rounded-xl bg-yellow-50
                            border border-yellow-200">
                    <p class="font-semibold text-yellow-800">
                        Not enough approved work to evaluate
                    </p>

                    <p class="text-sm text-yellow-700 mt-1">
                        Contribution percentages will appear after
                        the group earns approved task points.
                    </p>
                </div>
            @endunless

            {{-- Member Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm">
                        <tr>
                            <th class="px-6 py-4 font-semibold">
                                Student
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Approved Points
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Contribution
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Threshold
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($report['members'] as $member)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">
                                        {{ $member['student']->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $member['student']->email }}
                                    </p>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $member['approved_points'] }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($member['contribution'] !== null)
                                        <span class="font-semibold text-gray-900">
                                            {{ number_format(
                                                $member['contribution'],
                                                2
                                            ) }}%
                                        </span>
                                    @else
                                        <span class="text-gray-400">
                                            Not available
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ number_format($threshold, 2) }}%
                                </td>

                                <td class="px-6 py-4">
                                    @if(!$report['has_enough_work'])
                                        <span class="inline-flex px-3 py-1
                                                     rounded-full text-xs
                                                     font-semibold bg-gray-100
                                                     text-gray-600">
                                            Awaiting approved work
                                        </span>

                                    @elseif($member['is_below_threshold'])
                                        <span class="inline-flex px-3 py-1
                                                     rounded-full text-xs
                                                     font-semibold bg-red-100
                                                     text-red-700">
                                            Review needed
                                        </span>

                                    @else
                                        <span class="inline-flex px-3 py-1
                                                     rounded-full text-xs
                                                     font-semibold bg-green-100
                                                     text-green-700">
                                            Meets threshold
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-8 text-center
                                           text-gray-500">
                                    This group has no members.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @empty
        <div class="bg-white border border-gray-200 rounded-2xl
                    p-10 text-center">
            <h2 class="text-lg font-semibold text-gray-800">
                No groups assigned
            </h2>

            <p class="text-gray-500 mt-2">
                Assign at least one group to this project to generate
                a workload report.
            </p>
        </div>
    @endforelse

</div>
@endsection