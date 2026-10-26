@extends('layouts.student')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header Banner --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600 mb-1">
                    {{ $class->course_code }}: {{ $class->course_name }}
                </p>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    {{ $group->name ?? 'Group Status & Contribution' }}
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ $group ? $group->students->count() . ' members assigned' : 'No group assigned' }}
                </p>
            </div>
            <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-5 py-3">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Overall Progress</span>
                <span class="text-xl font-bold text-gray-900">{{ $groupProgress }}%</span>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="mt-6 w-full bg-gray-100 h-3 rounded-full overflow-hidden">
            <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: {{ $groupProgress }}%"></div>
        </div>
    </div>


    {{-- Personal Contribution & Metrics Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Individual Contribution Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex flex-col items-center justify-center text-center">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-4">Your Contribution</p>
            <div class="relative w-32 h-32 flex items-center justify-center rounded-full border-8 border-indigo-50 bg-indigo-50/30">
                <span class="text-2xl font-bold text-gray-900">{{ $userContribution }}%</span>
            </div>
            <p class="text-xs text-gray-500 mt-4">Calculated from approved task contributions</p>
        </div>

        {{-- Task & Points Summary --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex flex-col justify-between space-y-4">
            <div>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Your Progress & Score</h3>
                <p class="text-xs text-gray-500 mt-0.5">Your personal standing within the group team tasks</p>
            </div>

            <div class="space-y-3">
                <div>
                    <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1">
                        <span>Task Completion</span>
                        <span>{{ $groupProgress }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $groupProgress }}%"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Your Contribution Points</p>
                    <p class="text-xs text-gray-400">Based on approved task assignments</p>
                </div>
                <div class="text-2xl font-bold text-gray-900">{{ $userPoints }} <span class="text-xs font-normal text-gray-500">pts</span></div>
            </div>
        </div>

    </div>


    {{-- Member Contributions & Details Table --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-900">Member Contributions & Status</h3>
                <p class="text-xs text-gray-500 mt-0.5">Task progress, on-time rates, and participation score for each member</p>
            </div>
            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg text-xs font-semibold">
                {{ $members->count() }} members
            </span>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($members as $member)
                <div class="px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-gray-50/50 transition-colors">
                    
                    <div class="flex items-center gap-3 min-w-[200px]">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-bold text-gray-900">{{ $member->name }}</p>
                                @if($member->is_leader)
                                    <span class="px-2 py-0.5 bg-indigo-100 text-indigo-800 rounded text-[10px] font-bold uppercase tracking-wide">Leader</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400">{{ $member->email }}</p>
                        </div>
                    </div>

                    <div class="flex-1 max-w-xs px-4">
                        <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1">
                            <span>Contribution Share</span>
                            <span class="text-indigo-600">{{ $member->contribution_percentage }}% ({{ $member->points }} pts)</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $member->contribution_percentage }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 text-xs text-gray-600">
                        <div>
                            <span class="block text-gray-400 text-[10px] uppercase font-semibold">Tasks</span>
                            <span class="font-bold text-gray-900">{{ $member->completed_tasks }} / {{ $member->assigned_tasks }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[10px] uppercase font-semibold">On-Time</span>
                            <span class="font-bold text-green-600">{{ $member->on_time_rate }}%</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[10px] uppercase font-semibold">Files</span>
                            <span class="font-bold text-gray-900">{{ $member->files_count }}</span>
                        </div>
                    </div>

                </div>
            @empty
                <div class="px-6 py-12 text-center text-gray-400 text-sm">
                    No group members found.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection