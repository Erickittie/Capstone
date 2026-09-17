@extends('layouts.instructor')

@section('title', 'Real-Time Task Ledger')

@section('content')

<div class="max-w-full space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Real-Time Task Ledger</h1>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold bg-red-50 text-red-600 rounded-full tracking-wider uppercase">
                <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-ping"></span>
                <span>Live Sync</span>
            </span>
        </div>
        <!-- Filters -->
        <div class="flex gap-2 flex-wrap">
            <select class="border border-gray-200 rounded-xl py-2 px-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900 text-xs font-semibold text-gray-600">
                <option>All Classes</option>
                <option>Advanced AI Ethics (CS-402)</option>
                <option>Quantitative Analysis II (MAT-301)</option>
            </select>
            <select class="border border-gray-200 rounded-xl py-2 px-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-900 text-xs font-semibold text-gray-600">
                <option>All Statuses</option>
                <option>To Do</option>
                <option>In Progress</option>
                <option>Under Review</option>
                <option>Completed</option>
            </select>
        </div>
    </div>

    <!-- Two-Column Layout: Table + Activity Feed -->
    <div class="flex flex-col lg:flex-row gap-6">

        <!-- Ledger Table -->
        <div class="flex-1 bg-white border border-gray-200/80 rounded-2xl shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                            <th class="px-6 py-3.5">Task Description</th>
                            <th class="px-6 py-3.5">Assigned To</th>
                            <th class="px-6 py-3.5">Group</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5">Last Committed</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ledger-body" class="divide-y divide-gray-100 text-sm text-gray-900">
                        <!-- Task 1 -->
                        <tr id="task-row-1" class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">Literature Review: Data Privacy</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs">LC</div>
                                    <span>Liam Chen</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Group Alpha</td>
                            <td class="px-6 py-4">
                                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">In Progress</span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">2 mins ago</td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                            </td>
                        </tr>
                        <!-- Task 2 -->
                        <tr id="task-row-2" class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">Initial API Documentation</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs">SM</div>
                                    <span>Sarah Miller</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Group Beta</td>
                            <td class="px-6 py-4">
                                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Under Review</span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">10 mins ago</td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                            </td>
                        </tr>
                        <!-- Task 3 -->
                        <tr id="task-row-3" class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">Database Schema Design</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-xs">EW</div>
                                    <span>Emma Wilson</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Group Gamma</td>
                            <td class="px-6 py-4">
                                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Completed</span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">25 mins ago</td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                            </td>
                        </tr>
                        <!-- Task 4 -->
                        <tr id="task-row-4" class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">Unit Testing Framework</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs">MA</div>
                                    <span>Marcus Aurelius</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 font-medium">Group Beta</td>
                            <td class="px-6 py-4">
                                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">To Do</span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">1 hour ago</td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="w-full lg:w-[300px] bg-white border border-gray-200/80 rounded-2xl shadow-xs flex flex-col flex-shrink-0 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-500 text-[20px]">trending_up</span>
                    <h3 class="text-sm font-bold text-gray-900">Activity Feed</h3>
                </div>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div id="live-activity-feed" class="p-4 space-y-4 overflow-y-auto flex-1 divide-y divide-gray-100">
                <div class="pt-3 first:pt-0 flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-gray-500 mt-0.5 text-[18px]">commit</span>
                    <div class="flex-1 text-xs text-gray-700">
                        <p><strong>Emma Wilson</strong> pushed 3 commits to <code class="bg-gray-100 px-1 py-0.5 rounded text-[11px] font-mono">model-refactor</code></p>
                        <span class="text-[10px] text-gray-400 block mt-1">Just now</span>
                    </div>
                </div>
                <div class="pt-3 flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-amber-500 mt-0.5 text-[18px]">change_circle</span>
                    <div class="flex-1 text-xs text-gray-700">
                        <p><strong>Liam Chen</strong> moved <strong>Literature Review</strong> to <span class="bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded text-[10px] font-semibold">In Progress</span></p>
                        <span class="text-[10px] text-gray-400 block mt-1">2 mins ago</span>
                    </div>
                </div>
                <div class="pt-3 flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-blue-500 mt-0.5 text-[18px]">rate_review</span>
                    <div class="flex-1 text-xs text-gray-700">
                        <p><strong>Sarah Miller</strong> requested feedback on <strong>Initial API Documentation</strong></p>
                        <span class="text-[10px] text-gray-400 block mt-1">10 mins ago</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<style>
    @keyframes flash { 0%,100% { background-color: transparent; } 50% { background-color: #fef3c7; } }
    .flash-update { animation: flash 1s ease 2; }
</style>
<script>
    const ledgerBody = document.getElementById('ledger-body');
    const feedContainer = document.getElementById('live-activity-feed');

    const simulatedUpdates = [
        {
            rowId: 'task-row-4', newStatus: 'In Progress',
            badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800',
            timeText: 'Just now', feedIcon: 'change_circle', feedIconColor: 'text-amber-500',
            feedMessage: '<strong>Marcus Aurelius</strong> moved <strong>Unit Testing Framework</strong> to <span class="bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded text-[10px] font-semibold">In Progress</span>'
        },
        {
            rowId: 'task-row-1', newStatus: 'Under Review',
            badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800',
            timeText: 'Just now', feedIcon: 'rate_review', feedIconColor: 'text-blue-500',
            feedMessage: '<strong>Liam Chen</strong> requested review for <strong>Literature Review: Data Privacy</strong>'
        },
        {
            rowId: 'task-row-2', newStatus: 'Completed',
            badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800',
            timeText: 'Just now', feedIcon: 'check_circle', feedIconColor: 'text-emerald-500',
            feedMessage: '<strong>Sarah Miller</strong> completed <strong>Initial API Documentation</strong>'
        }
    ];

    let simulatedIndex = 0;
    function runLiveUpdateSimulation() {
        if (simulatedIndex >= simulatedUpdates.length) simulatedIndex = 0;
        const update = simulatedUpdates[simulatedIndex];
        const row = document.getElementById(update.rowId);
        if (row) {
            row.classList.add('flash-update');
            setTimeout(() => row.classList.remove('flash-update'), 2000);
            const badge = row.querySelector('.status-badge');
            if (badge) { badge.textContent = update.newStatus; badge.className = update.badgeClass; }
            const timeCell = row.cells[4];
            if (timeCell) timeCell.textContent = update.timeText;
        }
        const feedItem = document.createElement('div');
        feedItem.className = 'pt-3 flex items-start gap-2.5 border-t border-gray-100';
        feedItem.innerHTML = `<span class="material-symbols-outlined ${update.feedIconColor} mt-0.5 text-[18px]">${update.feedIcon}</span><div class="flex-1 text-xs text-gray-700"><p>${update.feedMessage}</p><span class="text-[10px] text-gray-400 block mt-1">${update.timeText}</span></div>`;
        feedContainer.insertBefore(feedItem, feedContainer.firstChild);
        if (feedContainer.children.length > 8) feedContainer.removeChild(feedContainer.lastChild);
        simulatedIndex++;
    }
    setInterval(runLiveUpdateSimulation, 6000);
</script>
@endsection
