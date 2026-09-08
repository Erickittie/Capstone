@extends('layouts.instructor')

@section('content')

<div>

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div class="flex items-center gap-4">

            <a
                href="{{ route('instructor.class.configure', $class->id) }}"
                class="w-10 h-10 flex items-center justify-center
                       rounded-lg border border-gray-200
                       bg-white text-gray-500
                       hover:text-blue-600
                       hover:border-blue-300
                       transition"
            >
                ←
            </a>

            <div>

                <h1 class="text-3xl font-bold text-gray-900">
                    Task Ledger
                </h1>

                <p class="text-gray-500 mt-1">
                    Monitor task progress, submissions, and approvals.
                </p>

            </div>

        </div>


        <div class="text-sm text-gray-500">

            <span class="font-semibold text-gray-800">
                {{ $class->course_code }}
            </span>

            ·

            {{ $class->section }}

        </div>

    </div>


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}

    @php

        $totalAssignments = count($rows);

        $submittedCount = collect($rows)
            ->where('submission_status', '!=', 'Not Submitted')
            ->count();

        $approvedCount = collect($rows)
            ->where('submission_status', 'Approved')
            ->count();

        $pendingCount = collect($rows)
            ->where('submission_status', 'Pending')
            ->count();

    @endphp


    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">


        {{-- Total --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-200
                   p-5"
        >

            <p class="text-sm text-gray-500">
                Total Assignments
            </p>

            <p class="text-3xl font-bold text-gray-900 mt-2">
                {{ $totalAssignments }}
            </p>

        </div>


        {{-- Submitted --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-200
                   p-5"
        >

            <p class="text-sm text-gray-500">
                Submitted
            </p>

            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ $submittedCount }}
            </p>

        </div>


        {{-- Pending --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-200
                   p-5"
        >

            <p class="text-sm text-gray-500">
                Pending Review
            </p>

            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $pendingCount }}
            </p>

        </div>


        {{-- Approved --}}
        <div
            class="bg-white rounded-2xl
                   border border-gray-200
                   p-5"
        >

            <p class="text-sm text-gray-500">
                Approved
            </p>

            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ $approvedCount }}
            </p>

        </div>

    </div>


    {{-- =========================================================
        FILTERS
    ========================================================== --}}

    <div
        class="bg-white rounded-2xl
               border border-gray-200
               p-5 mb-6"
    >

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


            {{-- Search --}}
            <div>

                <label
                    for="search"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Search
                </label>

                <input
                    id="search"
                    type="text"
                    placeholder="Search task or student..."
                    class="w-full rounded-lg
                           border border-gray-300
                           px-4 py-2.5
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           outline-none"
                >

            </div>


            {{-- Group --}}
            <div>

                <label
                    for="groupFilter"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Group
                </label>

                <select
                    id="groupFilter"
                    class="w-full rounded-lg
                           border border-gray-300
                           px-4 py-2.5
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           outline-none"
                >

                    <option value="">
                        All Groups
                    </option>

                    @foreach($class->groups as $group)

                        <option value="{{ $group->name }}">
                            {{ $group->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div>

                <label
                    for="statusFilter"
                    class="block text-sm font-semibold
                           text-gray-700 mb-2"
                >
                    Status
                </label>

                <select
                    id="statusFilter"
                    class="w-full rounded-lg
                           border border-gray-300
                           px-4 py-2.5
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           outline-none"
                >

                    <option value="">
                        All Status
                    </option>

                    <option value="Assigned">
                        Assigned
                    </option>

                    <option value="In Progress">
                        In Progress
                    </option>

                    <option value="Completed">
                        Completed
                    </option>

                    <option value="Pending">
                        Pending Review
                    </option>

                    <option value="Approved">
                        Approved
                    </option>

                </select>

            </div>

        </div>

    </div>


    {{-- =========================================================
        TASK LEDGER TABLE
    ========================================================== --}}

    <div
        class="bg-white rounded-2xl
               border border-gray-200
               overflow-hidden"
    >

        <div
            class="px-6 py-5
                   border-b border-gray-200
                   flex items-center justify-between"
        >

            <div>

                <h2 class="font-bold text-gray-900">
                    Task Activity
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Student task assignments and submission status.
                </p>

            </div>


            <div
                class="flex items-center gap-2
                       text-xs text-gray-500"
            >

                <span
                    id="liveIndicator"
                    class="w-2 h-2
                           rounded-full
                           bg-green-500"
                ></span>

                Live

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50">

                    <tr>

                        <th
                            class="px-6 py-4
                                   text-left
                                   font-semibold
                                   text-gray-600"
                        >
                            Task
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   font-semibold
                                   text-gray-600"
                        >
                            Group
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   font-semibold
                                   text-gray-600"
                        >
                            Student
                        </th>

                        <th
                            class="px-6 py-4
                                   text-center
                                   font-semibold
                                   text-gray-600"
                        >
                            Points
                        </th>

                        <th
                            class="px-6 py-4
                                   text-center
                                   font-semibold
                                   text-gray-600"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4
                                   text-center
                                   font-semibold
                                   text-gray-600"
                        >
                            Submitted
                        </th>

                        <th
                            class="px-6 py-4
                                   text-center
                                   font-semibold
                                   text-gray-600"
                        >
                            Approved
                        </th>

                    </tr>

                </thead>


                <tbody
                    id="ledgerBody"
                    class="divide-y divide-gray-100"
                >

                    @forelse($rows as $row)

                        <tr
                            class="ledger-row hover:bg-gray-50 transition"
                            data-task="{{ strtolower($row['task_title']) }}"
                            data-student="{{ strtolower($row['student_name']) }}"
                            data-group="{{ strtolower($row['group_name']) }}"
                            data-status="{{ strtolower($row['assignment_status']) }}"
                            data-submission="{{ strtolower($row['submission_status']) }}"
                        >

                            {{-- Task --}}
                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-900">
                                    {{ $row['task_title'] }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $row['project_title'] }}
                                </div>

                            </td>


                            {{-- Group --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $row['group_name'] }}
                            </td>


                            {{-- Student --}}
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $row['student_name'] }}
                                </div>

                                <div class="text-xs text-gray-400">
                                    ID: {{ $row['student_id'] }}
                                </div>

                            </td>


                            {{-- Points --}}
                            <td
                                class="px-6 py-4
                                       text-center
                                       font-semibold
                                       text-gray-800"
                            >
                                {{ $row['points'] }}
                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">

                                @php
                                    $status = $row['assignment_status'];
                                @endphp

                                @if($status === 'Completed')

                                    <span
                                        class="inline-flex
                                               px-3 py-1
                                               rounded-full
                                               bg-green-100
                                               text-green-700
                                               text-xs
                                               font-semibold"
                                    >
                                        Completed
                                    </span>

                                @elseif($status === 'In Progress')

                                    <span
                                        class="inline-flex
                                               px-3 py-1
                                               rounded-full
                                               bg-blue-100
                                               text-blue-700
                                               text-xs
                                               font-semibold"
                                    >
                                        In Progress
                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               px-3 py-1
                                               rounded-full
                                               bg-gray-100
                                               text-gray-600
                                               text-xs
                                               font-semibold"
                                    >
                                        {{ $status }}
                                    </span>

                                @endif

                            </td>


                            {{-- Submitted --}}
                            <td class="px-6 py-4 text-center">

                                @if($row['submitted_at'])

                                    <div
                                        class="text-green-600
                                               font-semibold"
                                    >
                                        ✓ Submitted
                                    </div>

                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ \Carbon\Carbon::parse(
                                            $row['submitted_at']
                                        )->format('M d, Y h:i A') }}
                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Approved --}}
                            <td class="px-6 py-4 text-center">

                                @if($row['approved_at'])

                                    <div
                                        class="text-green-600
                                               font-semibold"
                                    >
                                        ✓ Approved
                                    </div>

                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ \Carbon\Carbon::parse(
                                            $row['approved_at']
                                        )->format('M d, Y h:i A') }}
                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        —
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16
                                       text-center"
                            >

                                <div class="text-5xl mb-4">
                                    📋
                                </div>

                                <h3
                                    class="text-lg
                                           font-semibold
                                           text-gray-800"
                                >
                                    No Task Activity Yet
                                </h3>

                                <p
                                    class="text-sm
                                           text-gray-500
                                           mt-1"
                                >
                                    Tasks assigned to students
                                    will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
        LAST UPDATED
    ========================================================== --}}

    <div class="mt-4 text-right">

        <span class="text-xs text-gray-400">
            Last updated:
        </span>

        <span
            id="lastUpdated"
            class="text-xs text-gray-500"
        >
            Just now
        </span>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | FILTERING
    |--------------------------------------------------------------------------
    */

    function filterLedger()
    {
        const search =
            document
                .getElementById('search')
                .value
                .toLowerCase()
                .trim();

        const group =
            document
                .getElementById('groupFilter')
                .value
                .toLowerCase();

        const status =
            document
                .getElementById('statusFilter')
                .value
                .toLowerCase();


        const rows =
            document.querySelectorAll('.ledger-row');


        rows.forEach(function(row)
        {
            const task =
                row.dataset.task || '';

            const student =
                row.dataset.student || '';

            const rowGroup =
                row.dataset.group || '';

            const rowStatus =
                row.dataset.status || '';

            const submission =
                row.dataset.submission || '';


            const matchesSearch =
                !search ||
                task.includes(search) ||
                student.includes(search);


            const matchesGroup =
                !group ||
                rowGroup === group;


            const matchesStatus =
                !status ||
                rowStatus === status ||
                submission === status;


            if (
                matchesSearch &&
                matchesGroup &&
                matchesStatus
            ) {

                row.classList.remove('hidden');

            } else {

                row.classList.add('hidden');

            }

        });
    }


    document
        .getElementById('search')
        .addEventListener(
            'input',
            filterLedger
        );


    document
        .getElementById('groupFilter')
        .addEventListener(
            'change',
            filterLedger
        );


    document
        .getElementById('statusFilter')
        .addEventListener(
            'change',
            filterLedger
        );


    /*
    |--------------------------------------------------------------------------
    | LIVE REFRESH
    |--------------------------------------------------------------------------
    |
    | We will use polling first.
    | Later we can replace this with Laravel Reverb/WebSockets.
    |
    */

    function refreshLedger()
    {
        fetch(
            "{{ route(
                'instructor.tasks.ledger.data',
                $class->id
            ) }}"
        )
        .then(response => response.json())
        .then(data => {

            /*
             * For now we simply update the timestamp.
             *
             * The next improvement will rebuild the table
             * dynamically from data.rows.
             */

            document
                .getElementById('lastUpdated')
                .textContent =
                    data.updated_at;

        })
        .catch(error => {

            console.error(
                'Unable to refresh task ledger:',
                error
            );

        });
    }


    /*
     * Refresh every 10 seconds.
     */
    setInterval(
        refreshLedger,
        10000
    );

</script>

@endsection