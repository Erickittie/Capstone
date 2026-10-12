@extends('layouts.student')

@section('title', 'Group Status - ' . $class->course_code)

@section('content')

<div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">

    @if($group)
        {{-- Group Progress Overview --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">{{ $group->name }}</h3>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $group->students->count() }} members assigned</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Overall Progress</span>
                    <span class="text-2xl font-bold text-gray-900">{{ number_format($groupProgress, 1) }}%</span>
                </div>
            </div>
            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden mb-2">
                <div class="h-full bg-blue-600 rounded-full transition-all" style="width: {{ min($groupProgress, 100) }}%"></div>
            </div>
        </div>

        {{-- Members Contribution Table --}}
        <div class="bg-white rounded-xl border border-gray-200 mb-8">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Member Contributions</h3>
                <p class="text-sm text-gray-500 mt-0.5">Task progress and participation for each group member</p>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($members as $member)
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        
                        {{-- Member Info --}}
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-sm font-bold text-blue-700">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $member->name }}
                                    @if($member->id === auth()->id())
                                        <span class="text-xs font-normal text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded ml-1">You</span>
                                    @endif
                                    @if($member->is_leader)
                                        <span class="text-xs font-normal text-purple-600 bg-purple-50 px-1.5 py-0.5 rounded ml-1">Leader</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-400">Team Member</p>
                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-blue-700">{{ number_format($member->progress, 1) }}%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full transition-all" style="width: {{ min($member->progress, 100) }}%"></div>
                            </div>
                        </div>

                        {{-- Stats Display (Conditional for Leader) --}}
                        <div class="flex items-center gap-4 text-center min-w-[120px]">
                            <div>
                                <p class="text-xs text-gray-400">Tasks</p>
                                <p class="text-sm font-bold text-gray-900">{{ $member->completed_tasks }}/{{ $member->assigned_tasks }}</p>
                            </div>

                            @if($isLeader)
                                <div>
                                    <p class="text-xs text-gray-400">On Time</p>
                                    <p class="text-sm font-bold {{ $member->on_time_rate >= 80 ? 'text-green-600' : 'text-amber-600' }}">
                                        {{ $member->on_time_rate }}%
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">Files</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $member->files_count }}</p>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <span class="material-symbols-outlined text-gray-300 text-5xl">groups</span>
            <h3 class="font-bold text-gray-900 mt-3 text-lg">No Group Assigned Yet</h3>
            <p class="text-sm text-gray-500 mt-1">You have not been assigned to a group for this class yet.</p>
        </div>
    @endif

</div>

@endsection