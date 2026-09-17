@extends('layouts.instructor')

@section('title', 'Create a New Class')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Create a New Class</h1>
        <p class="text-gray-500 text-sm mt-0.5">Establish your class workspace, register academic parameters, and import your student roster.</p>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl px-5 py-4 text-sm shadow-xs">
            <span class="material-symbols-outlined text-emerald-600 text-[22px]">check_circle</span>
            <div class="flex-1 font-medium">{{ session('success') }}</div>
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

    <!-- Two-Column Workspace Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

        <!-- Left: Class Details Form -->
        <div class="lg:col-span-3 bg-white border border-gray-200/80 rounded-2xl shadow-xs overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600 text-[20px]">class</span>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-900">Class Details</h2>
                    <p class="text-xs text-gray-500">Fill in the academic parameters for this class.</p>
                </div>
            </div>
            <form class="p-6 space-y-5" method="POST" action="{{ route('instructor.class.store') ?? '#' }}">
                @csrf

                <!-- Course Name & Code -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label for="course-name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course Name</label>
                        <input type="text" id="course-name" name="course_name" value="{{ old('course_name') }}"
                               placeholder="e.g. Intro to Applied Cryptography"
                               class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                    </div>
                    <div>
                        <label for="course-code" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course Code</label>
                        <input type="text" id="course-code" name="course_code" value="{{ old('course_code') }}"
                               placeholder="e.g. CS-450"
                               class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                    </div>
                </div>

                <!-- Section & Department -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="section" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Section</label>
                        <input type="text" id="section" name="section" value="{{ old('section') }}"
                               placeholder="e.g. A or IT1-1"
                               class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                    </div>
                    <div>
                        <label for="dept" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Department</label>
                        <input type="text" id="dept" name="department" value="{{ old('department') }}"
                               placeholder="e.g. Computer Science"
                               class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                    </div>
                </div>

                <!-- Semester & Academic Year -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="semester" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Semester</label>
                        <select id="semester" name="semester"
                                class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                    <div>
                        <label for="academic_year" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Academic Year</label>
                        <input type="text" id="academic_year" name="academic_year" value="{{ old('academic_year') }}"
                               placeholder="e.g. 2025-2026"
                               class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                    </div>
                </div>

                <!-- Schedule -->
                <div>
                    <label for="schedule" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Class Schedule</label>
                    <input type="text" id="schedule" name="schedule" value="{{ old('schedule') }}"
                           placeholder="e.g. MWF 10:00 AM – 11:00 AM"
                           class="w-full border border-gray-200 rounded-xl text-sm py-2.5 px-3.5 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition bg-gray-50/50">
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button type="submit"
                            class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-semibold text-sm rounded-xl shadow-xs hover:shadow transition duration-200 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        Save Class & Initialize Roster
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Import Student Roster -->
        <div class="lg:col-span-2 space-y-5">

            <div class="bg-white border border-gray-200/80 rounded-2xl shadow-xs p-6 space-y-5">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-purple-600 text-[20px]">upload_file</span>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-gray-900">Import Student Roster</h2>
                            <p class="text-xs text-gray-500">Upload a CSV file to pre-populate students.</p>
                        </div>
                    </div>
                </div>

                <!-- Drag-and-drop zone -->
                <div id="drop-zone" class="border-2 border-dashed border-gray-200 hover:border-gray-900 rounded-2xl p-8 text-center cursor-pointer transition bg-gray-50/50 hover:bg-gray-50 flex flex-col items-center justify-center space-y-3 group">
                    <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-gray-900 transition">cloud_upload</span>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Drag & drop your CSV file here</p>
                        <p class="text-xs text-gray-400 mt-1">Accepts: Name, Email, StudentID columns</p>
                    </div>
                    <input type="file" id="csv-file-input" class="hidden" accept=".csv">
                    <button type="button" id="browse-btn" class="px-4 py-2 border border-gray-200 hover:bg-white text-gray-700 font-semibold text-xs rounded-xl transition duration-200 bg-gray-50">
                        Browse Files
                    </button>
                </div>

                <!-- Template download -->
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-200">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-gray-500 text-[18px]">download</span>
                        <div class="text-xs">
                            <span class="font-semibold block text-gray-900">Roster Template</span>
                            <span class="text-gray-400 block -mt-0.5">CSV formatting template</span>
                        </div>
                    </div>
                    <a href="#" class="text-xs font-semibold text-blue-600 hover:underline">Download</a>
                </div>
            </div>

            <!-- CSV Preview Card -->
            <div id="roster-preview-card" class="bg-white border border-gray-200/80 rounded-2xl shadow-xs overflow-hidden hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-900">Import Preview (<span id="student-count">0</span> students)</h2>
                    <button id="clear-roster-btn" class="text-xs text-red-500 font-semibold hover:underline">Clear</button>
                </div>
                <div class="max-h-60 overflow-y-auto">
                    <table class="w-full text-left">
                        <tbody id="roster-preview-body" class="divide-y divide-gray-100 text-sm"></tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('csv-file-input');
    const browseBtn = document.getElementById('browse-btn');
    const previewCard = document.getElementById('roster-preview-card');
    const previewBody = document.getElementById('roster-preview-body');
    const studentCountSpan = document.getElementById('student-count');
    const clearBtn = document.getElementById('clear-roster-btn');

    const mockStudents = [
        { id: "2026-9041", name: "Liam Chen", email: "l.chen@institution.edu" },
        { id: "2026-8812", name: "Sarah Miller", email: "s.miller@institution.edu" },
        { id: "2026-3401", name: "Emma Wilson", email: "e.wilson@institution.edu" },
        { id: "2026-9099", name: "Marcus Aurelius", email: "m.aurelius@institution.edu" },
        { id: "2026-7811", name: "Sophia Reynolds", email: "s.reynolds@institution.edu" }
    ];

    function handleFileSelection() {
        previewBody.innerHTML = '';
        mockStudents.forEach(st => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/50 transition';
            tr.innerHTML = `
                <td class="px-5 py-3 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-700 text-xs">
                        ${st.name.split(' ').map(n => n[0]).join('')}
                    </div>
                    <div>
                        <span class="font-semibold text-gray-900 block leading-tight text-sm">${st.name}</span>
                        <span class="text-xs text-gray-400 block">${st.email}</span>
                    </div>
                </td>
                <td class="px-5 py-3 font-mono text-xs text-gray-500">${st.id}</td>
                <td class="px-5 py-3 text-right">
                    <span class="material-symbols-outlined text-emerald-500 text-[18px]">check_circle</span>
                </td>
            `;
            previewBody.appendChild(tr);
        });
        studentCountSpan.innerText = mockStudents.length;
        previewCard.classList.remove('hidden');
    }

    browseBtn.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFileSelection);
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('border-gray-900', 'bg-gray-100/50'); });
    dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-gray-900', 'bg-gray-100/50'); });
    dropZone.addEventListener('drop', (e) => { e.preventDefault(); dropZone.classList.remove('border-gray-900', 'bg-gray-100/50'); handleFileSelection(); });
    clearBtn.addEventListener('click', () => { previewCard.classList.add('hidden'); previewBody.innerHTML = ''; fileInput.value = ''; });
</script>
@endsection
