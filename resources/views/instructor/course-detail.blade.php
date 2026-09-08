@extends('layouts.instructor')

@section('content')

<div>

    {{-- =========================================================
        SUCCESS / ERROR MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <span class="text-xl">
                    ✅
                </span>

                <div>
                    <p class="font-semibold text-green-800">
                        Success
                    </p>

                    <p class="text-sm text-green-700 mt-1">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <span class="text-xl">
                    ⚠️
                </span>

                <div>
                    <p class="font-semibold text-red-800">
                        Error
                    </p>

                    <p class="text-sm text-red-700 mt-1">
                        {{ session('error') }}
                    </p>
                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <span class="text-xl">
                    ⚠️
                </span>

                <div>

                    <p class="font-semibold text-red-800">
                        Please check the following:
                    </p>

                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="flex items-center gap-4 mb-8">

        <a
            href="{{ route('instructor.dashboard') }}"
            class="w-10 h-10 flex items-center justify-center
                   rounded-lg border border-gray-200 bg-white
                   text-gray-500 hover:text-blue-600
                   hover:border-blue-300 transition"
        >
            ←
        </a>

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Class Configuration
            </h1>

            <p class="text-gray-500 mt-1">
                Configure and manage this class.
            </p>

        </div>

    </div>


    {{-- =========================================================
        CLASS INFORMATION
    ========================================================== --}}

    <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-8">

        <div class="flex items-center justify-between">

            <div>

                <span
                    class="inline-block px-3 py-1.5 rounded-full
                           bg-blue-100 text-blue-700
                           text-xs font-bold"
                >
                    {{ $class->course_code }}
                </span>


                <h2 class="text-2xl font-bold text-gray-900 mt-4">
                    {{ $class->course_name }}
                </h2>


                <p class="text-gray-500 mt-1">
                    Section: {{ $class->section }}
                </p>


                <p class="text-gray-500 mt-1">
                    {{ $class->semester }} • {{ $class->academic_year }}
                </p>


                <p class="text-xs text-gray-400 mt-3">
                    Class ID: {{ $class->id }}
                </p>

            </div>


            <div
                class="hidden md:flex w-16 h-16 rounded-2xl
                       bg-blue-50 items-center justify-center"
            >
                <span class="text-3xl">
                    📚
                </span>
            </div>

        </div>

    </div>


    {{-- =========================================================
        STUDENT ROSTER
    ========================================================== --}}

    <div class="mb-8">

        {{-- Roster Header --}}
        <div class="flex items-center justify-between mb-5">

            <div>

                <h2 class="text-xl font-bold text-gray-900">
                    Student Roster
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage students enrolled in this class.
                </p>

            </div>


            <div
                class="px-4 py-2 bg-blue-50
                       text-blue-700 rounded-lg
                       font-semibold text-sm"
            >
                {{ $class->students->count() }} Students
            </div>

        </div>


        {{-- =====================================================
            IMPORT CARD
        ====================================================== --}}

        <button
            type="button"
            onclick="openImportModal()"
            class="group w-full text-left
                   bg-white rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-blue-400
                   hover:shadow-lg
                   transition duration-200"
        >

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-5">

                    <div
                        class="w-14 h-14 rounded-xl
                               bg-blue-50
                               flex items-center justify-center
                               flex-shrink-0"
                    >
                        <span class="text-2xl">
                            👥
                        </span>
                    </div>


                    <div>

                        <h3
                            class="text-lg font-bold
                                   text-gray-900
                                   group-hover:text-blue-600
                                   transition"
                        >
                            Student Roster
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Import students into this class.
                        </p>

                    </div>

                </div>


                <div
                    class="text-gray-400
                           group-hover:text-blue-600
                           group-hover:translate-x-1
                           transition text-2xl"
                >
                    →
                </div>

            </div>


            <div
                class="mt-5 pt-5
                       border-t border-gray-100
                       flex items-center justify-between"
            >

                <div class="text-sm text-gray-500">

                    <span class="font-semibold text-gray-900">
                        {{ $class->students->count() }}
                    </span>

                    students currently enrolled

                </div>


                <span class="text-sm font-semibold text-blue-600">
                    Import Students
                </span>

            </div>

        </button>


        {{-- =====================================================
            ENROLLED STUDENTS
        ====================================================== --}}

        <div
            class="bg-white rounded-2xl
                   border border-gray-200
                   overflow-hidden mt-6"
        >

            <div
                class="px-6 py-4
                       border-b border-gray-200
                       bg-gray-50
                       flex items-center justify-between"
            >

                <div>

                    <h3 class="font-bold text-gray-900">
                        Enrolled Students
                    </h3>

                    <p class="text-xs text-gray-500 mt-1">
                        Students currently enrolled in this class.
                    </p>

                </div>


                <span
                    class="px-3 py-1
                           rounded-full
                           bg-white
                           border border-gray-200
                           text-sm font-semibold
                           text-gray-700"
                >
                    {{ $class->students->count() }}
                </span>

            </div>


            @forelse($class->students as $student)

                <div
                    class="px-6 py-4
                           border-b border-gray-100
                           last:border-b-0
                           flex flex-col
                           md:flex-row
                           md:items-center
                           md:justify-between
                           gap-3
                           hover:bg-gray-50
                           transition"
                >

                    <div class="flex items-center gap-4">

                        <div
                            class="w-10 h-10
                                   rounded-full
                                   bg-blue-100
                                   flex items-center
                                   justify-center
                                   text-blue-700
                                   font-bold"
                        >
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>


                        <div>

                            <p class="font-semibold text-gray-800">
                                {{ $student->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Student ID:
                                {{ $student->student_id ?? 'N/A' }}
                            </p>

                        </div>

                    </div>


                    <div class="text-sm text-gray-500">
                        {{ $student->email }}
                    </div>

                </div>

            @empty

                <div class="p-10 text-center">

                    <div class="text-4xl mb-3">
                        👨‍🎓
                    </div>

                    <h3 class="font-semibold text-gray-800">
                        No Students Enrolled
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Click the Student Roster card above
                        to import students.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- =========================================================
        IMPORT STUDENTS MODAL
    ========================================================== --}}

    <div
        id="importModal"
        class="hidden fixed inset-0 z-50
               bg-black/50
               items-center justify-center
               p-4"
        onclick="closeImportModalOutside(event)"
    >

        <div
            class="bg-white rounded-2xl
                   shadow-2xl
                   w-full max-w-lg
                   overflow-hidden"
            onclick="event.stopPropagation()"
        >

            {{-- Modal Header --}}
            <div
                class="flex items-center justify-between
                       p-6 border-b border-gray-200"
            >

                <div>

                    <h2 class="text-xl font-bold text-gray-900">
                        Import Students
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Add students to {{ $class->course_code }}
                    </p>

                </div>


                <button
                    type="button"
                    onclick="closeImportModal()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-gray-400
                           hover:bg-gray-100
                           hover:text-gray-700
                           text-2xl transition"
                >
                    ×
                </button>

            </div>


            {{-- Modal Body --}}
            <div class="p-6">

                <div
                    class="bg-blue-50
                           border border-blue-100
                           rounded-xl
                           p-4 mb-6"
                >

                    <div class="flex gap-3">

                        <div class="text-xl">
                            💡
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-blue-800">
                                CSV Format
                            </p>

                            <p class="text-xs text-blue-700 mt-1">
                                Your CSV must contain:
                                <strong>student_id</strong>,
                                <strong>name</strong>, and
                                <strong>email</strong>.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Upload Form --}}
                <form
                    action="{{ route(
                        'instructor.class.roster.import',
                        $class->id
                    ) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <label
                        for="roster"
                        class="block cursor-pointer"
                    >

                        <div
                            class="border-2
                                   border-dashed
                                   border-gray-300
                                   rounded-xl
                                   p-8
                                   text-center
                                   hover:border-blue-400
                                   hover:bg-blue-50/30
                                   transition"
                        >

                            <div class="text-4xl mb-3">
                                📄
                            </div>

                            <p class="font-semibold text-gray-700">
                                Choose CSV file
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Click here to browse your computer
                            </p>

                            <p class="text-xs text-gray-400 mt-2">
                                CSV or TXT • Maximum 2MB
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


                    <div
                        id="selectedFile"
                        class="hidden mt-4
                               p-3
                               bg-gray-50
                               border border-gray-200
                               rounded-lg
                               text-sm text-gray-600"
                    >
                    </div>


                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="button"
                            onclick="closeImportModal()"
                            class="px-5 py-2.5
                                   rounded-lg
                                   border border-gray-300
                                   text-gray-700
                                   hover:bg-gray-50
                                   transition"
                        >
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="px-5 py-2.5
                                   rounded-lg
                                   bg-blue-600
                                   text-white
                                   font-semibold
                                   hover:bg-blue-700
                                   transition"
                        >
                            Import Students
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CLASS MANAGEMENT
    ========================================================== --}}

    <div class="mb-5">

        <h2 class="text-xl font-bold text-gray-900">
            Class Management
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Choose what you want to manage.
        </p>

    </div>


    <div
        class="grid grid-cols-1
               md:grid-cols-2
               xl:grid-cols-3
               gap-6"
    >

        {{-- =====================================================
            PROJECTS
        ====================================================== --}}

        <a
            href="{{ route(
                'instructor.projects.index',
                $class->id
            ) }}"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-blue-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-blue-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    📋
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-blue-600"
            >
                Projects
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Create and manage academic projects.
            </p>

            <div class="mt-5 text-sm font-semibold text-blue-600">
                Manage Projects →
            </div>

        </a>


        {{-- =====================================================
            GROUPS
        ====================================================== --}}

        <a
            href="{{ route(
                'instructor.class.groups',
                $class->id
            ) }}"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-purple-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-purple-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    👥
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-purple-600"
            >
                Student Groups
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Create and manage student groups.
            </p>

            <div class="mt-5 text-sm font-semibold text-purple-600">
                Manage Groups →
            </div>

        </a>


        {{-- =====================================================
            TASK LEDGER
        ====================================================== --}}

        <a
            href="{{ route(
                'instructor.tasks.ledger',
                $class->id
            ) }}"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-green-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-green-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    ✅
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-green-600"
            >
                Task Ledger
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Monitor tasks, submissions, approvals, and progress.
            </p>

            <div class="mt-5 text-sm font-semibold text-green-600">
                View Task Ledger →
            </div>

        </a>


        {{-- =====================================================
            CHECK-IN
        ====================================================== --}}

        <a
            href="#"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-orange-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-orange-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    🕐
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-orange-600"
            >
                Check-in Requests
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Review student attendance requests.
            </p>

            <div class="mt-5 text-sm font-semibold text-orange-600">
                View Requests →
            </div>

        </a>


        {{-- =====================================================
            CONTRIBUTION
        ====================================================== --}}

        <a
            href="#"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-yellow-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-yellow-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    📊
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-yellow-600"
            >
                Contribution
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Monitor individual contribution scores.
            </p>

            <div class="mt-5 text-sm font-semibold text-yellow-600">
                View Contribution →
            </div>

        </a>


        {{-- =====================================================
            FILE REPOSITORY
        ====================================================== --}}

        <a
            href="#"
            class="group bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6
                   hover:border-indigo-400
                   hover:shadow-lg
                   transition"
        >

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-indigo-50
                       flex items-center
                       justify-center
                       mb-5"
            >

                <span class="text-2xl">
                    📁
                </span>

            </div>

            <h3
                class="text-lg font-bold
                       text-gray-900
                       group-hover:text-indigo-600"
            >
                File Repository
            </h3>

            <p class="text-sm text-gray-500 mt-2">
                Manage shared project files.
            </p>

            <div class="mt-5 text-sm font-semibold text-indigo-600">
                Open Repository →
            </div>

        </a>

    </div>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}

<script>

    function openImportModal()
    {
        const modal =
            document.getElementById('importModal');

        modal.classList.remove('hidden');

        modal.classList.add('flex');
    }


    function closeImportModal()
    {
        const modal =
            document.getElementById('importModal');

        modal.classList.add('hidden');

        modal.classList.remove('flex');
    }


    function closeImportModalOutside(event)
    {
        if (event.target === event.currentTarget) {

            closeImportModal();

        }
    }


    function showSelectedFile(input)
    {
        const selectedFile =
            document.getElementById('selectedFile');


        if (
            input.files &&
            input.files.length > 0
        ) {

            selectedFile.textContent =
                'Selected file: ' +
                input.files[0].name;

            selectedFile.classList.remove('hidden');

        } else {

            selectedFile.textContent = '';

            selectedFile.classList.add('hidden');

        }
    }


    // Close modal using ESC
    document.addEventListener(
        'keydown',
        function(event)
        {
            if (event.key === 'Escape') {

                closeImportModal();

            }
        }
    );

</script>

@endsection