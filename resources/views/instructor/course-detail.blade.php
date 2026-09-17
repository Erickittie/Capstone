@extends('layouts.instructor')

@section('content')

<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Flash & Alert Messages -->
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 text-sm shadow-xs">
            <span class="material-symbols-outlined text-emerald-600 text-[22px]">check_circle</span>
            <div class="flex-1 font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm shadow-xs">
            <span class="material-symbols-outlined text-red-500 text-[22px]">error</span>
            <div class="flex-1 font-medium">{{ session('error') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm shadow-xs">
            <span class="material-symbols-outlined text-red-500 text-[22px] mt-0.5">warning</span>
            <div>
                <p class="font-bold">Please check the following errors:</p>
                <ul class="list-disc list-inside mt-1 text-xs space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Page Header & Breadcrumb -->
    <div class="flex items-center gap-4">
        <a href="{{ route('instructor.dashboard') }}"
           class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 hover:text-gray-900 hover:border-gray-300 hover:bg-gray-50 shadow-xs transition duration-150">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>

        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Class Configuration
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Configure curriculum, manage student rosters, and supervise team groups.
            </p>
        </div>
    </div>

    <!-- Class Information Banner Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-7 shadow-xs hover:shadow-md transition duration-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60 text-xs font-mono font-bold tracking-wide">
                        {{ $class->course_code }}
                    </span>
                    <span class="text-xs text-gray-400 font-medium">Class #{{ $class->id }}</span>
                </div>

                <h2 class="text-2xl font-black tracking-tight text-gray-900">
                    {{ $class->course_name }}
                </h2>

                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 pt-1">
                    <span class="flex items-center gap-1.5 font-medium text-gray-700">
                        <span class="material-symbols-outlined text-[16px] text-gray-400">group_work</span>
                        Section: {{ $class->section }}
                    </span>
                    <span class="text-gray-300">&bull;</span>
                    <span class="flex items-center gap-1.5 font-medium text-gray-700">
                        <span class="material-symbols-outlined text-[16px] text-gray-400">calendar_month</span>
                        {{ $class->semester }} &bull; {{ $class->academic_year }}
                    </span>
                </div>
            </div>

            <div class="hidden sm:flex w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[32px]">
                    menu_book
                </span>
            </div>
        </div>
    </div>

    <!-- Student Roster Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    Student Roster
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    Manage and import student accounts registered in this class.
                </p>
            </div>

            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold border border-blue-100">
                {{ $class->students->count() }} Students
            </span>
        </div>

        <!-- Import Roster Action Card -->
        <button
            type="button"
            onclick="openImportModal()"
            class="group w-full text-left bg-white rounded-2xl border border-gray-200/80 p-6 hover:border-blue-400 hover:shadow-md transition duration-200 cursor-pointer">

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[26px]">
                            person_add
                        </span>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                            Import Student Roster
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Upload CSV batch roster with student IDs and institutional emails.
                        </p>
                    </div>
                </div>

                <div class="w-8 h-8 rounded-full bg-gray-50 group-hover:bg-blue-50 flex items-center justify-center text-gray-400 group-hover:text-blue-600 transition">
                    <span class="material-symbols-outlined text-[18px]">
                        arrow_forward
                    </span>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">
                    <strong class="text-gray-900 font-semibold">{{ $class->students->count() }}</strong> students currently enrolled
                </span>
                <span class="font-semibold text-blue-600 group-hover:underline">
                    Upload Roster CSV &rarr;
                </span>
            </div>
        </button>

        <!-- Enrolled Students Data Box -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-900">
                        Enrolled Students List
                    </h3>
                    <p class="text-xs text-gray-400">
                        Active student members verified in the course ledger.
                    </p>
                </div>

                <span class="px-2.5 py-0.5 rounded-full bg-white border border-gray-200 text-xs font-semibold text-gray-600">
                    {{ $class->students->count() }}
                </span>
            </div>

            @forelse($class->students as $student)
                <div class="px-6 py-3.5 border-b border-gray-100 last:border-b-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 hover:bg-gray-50/60 transition">
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center border border-blue-200">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 leading-tight">
                                {{ $student->name }}
                            </p>
                            <p class="text-xs text-gray-400 font-mono mt-0.5">
                                ID: {{ $student->student_id ?? 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="text-xs text-gray-500 font-medium">
                        {{ $student->email }}
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-gray-400">
                    <div class="w-14 h-14 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-[28px]">
                            school
                        </span>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-700">
                        No Students Enrolled
                    </h3>
                    <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">
                        Click the "Import Student Roster" card above to bulk enroll students from a CSV file.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Class Management Grid (6 Modules) -->
    <div class="space-y-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">
                Class Management
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">
                Navigate to core academic supervision modules for this course.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- 1. Projects -->
            <a href="{{ route('instructor.projects.index', $class->id) }}"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-blue-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">assignment</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                        Projects
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Create milestones, setup deliverables, and schedule phase deadlines.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 group-hover:underline">
                        Manage Projects &rarr;
                    </span>
                </div>
            </a>

            <!-- 2. Student Groups -->
            <a href="{{ route('instructor.class.groups', $class->id) }}"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-purple-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">groups</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-purple-600 transition-colors">
                        Student Groups
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Form manual or automated balanced groups and assign team captains.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-purple-600 group-hover:underline">
                        Manage Groups &rarr;
                    </span>
                </div>
            </a>

            <!-- 3. Task Ledger -->
            <a href="{{ route('instructor.tasks.ledger', $class->id) }}"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-emerald-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">task_alt</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">
                        Task Ledger
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Monitor individual contributions, submitted work, and verification statuses.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 group-hover:underline">
                        View Task Ledger &rarr;
                    </span>
                </div>
            </a>

            <!-- 4. Check-in Requests -->
            <a href="#"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-amber-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">schedule</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-amber-600 transition-colors">
                        Check-in Requests
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Review attendance checkpoints and verify group meeting logs.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 group-hover:underline">
                        View Requests &rarr;
                    </span>
                </div>
            </a>

            <!-- 5. Contribution -->
            <a href="#"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-teal-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">monitoring</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-teal-600 transition-colors">
                        Contribution
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Track commit activity distributions and peer evaluation fairness scores.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-teal-600 group-hover:underline">
                        View Contribution &rarr;
                    </span>
                </div>
            </a>

            <!-- 6. File Repository -->
            <a href="#"
               class="group bg-white rounded-2xl border border-gray-200/80 p-6 shadow-xs hover:border-indigo-400 hover:shadow-md transition duration-200 flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[24px]">folder_open</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                        File Repository
                    </h3>
                    <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                        Access shared syllabus, templates, and project source artifacts.
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-gray-100">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 group-hover:underline">
                        Open Repository &rarr;
                    </span>
                </div>
            </a>

        </div>
    </div>

</div>

<!-- Import Students Modal -->
<div
    id="importModal"
    class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-xs items-center justify-center p-4"
    onclick="closeImportModalOutside(event)"
>
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-200"
        onclick="event.stopPropagation()"
    >
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    Import Student Roster
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    Enroll student batch for {{ $class->course_code }}
                </p>
            </div>

            <button
                type="button"
                onclick="closeImportModal()"
                class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-5 flex gap-3 text-xs text-blue-800">
                <span class="material-symbols-outlined text-blue-600 text-[20px] shrink-0">info</span>
                <div>
                    <p class="font-semibold">Required CSV Columns:</p>
                    <p class="text-blue-700 mt-0.5">
                        Your CSV headers must include: <code class="font-mono bg-blue-100/80 px-1 py-0.5 rounded text-blue-900 font-semibold">student_id</code>, <code class="font-mono bg-blue-100/80 px-1 py-0.5 rounded text-blue-900 font-semibold">name</code>, and <code class="font-mono bg-blue-100/80 px-1 py-0.5 rounded text-blue-900 font-semibold">email</code>.
                    </p>
                </div>
            </div>

            <form
                action="{{ route('instructor.class.roster.import', $class->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4"
            >
                @csrf

                <label for="roster" class="block cursor-pointer">
                    <div class="border-2 border-dashed border-gray-300 hover:border-blue-500 rounded-2xl p-8 text-center bg-gray-50/50 hover:bg-blue-50/30 transition">
                        <span class="material-symbols-outlined text-gray-400 text-[36px] block mb-2">
                            upload_file
                        </span>
                        <p class="text-sm font-semibold text-gray-700">
                            Click to select CSV roster file
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Supported: .csv or .txt (Max 2MB)
                        </p>

                        <input
                            type="file"
                            name="roster"
                            id="roster"
                            accept=".csv,.txt,text/csv,text/plain"
                            required
                            class="hidden"
                            onchange="showSelectedFile(this)"
                        >
                    </div>
                </label>

                <div id="selectedFile" class="hidden p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-800 font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-emerald-600">check_circle</span>
                    <span id="selectedFileName"></span>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button
                        type="button"
                        onclick="closeImportModal()"
                        class="px-4 py-2 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs hover:shadow transition duration-150"
                    >
                        Import Students
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
