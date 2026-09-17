@extends('layouts.admin')

@section('content')

@php
    $instructorList = \App\Models\User::where('role', 'Instructor')->get();
@endphp

<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Course Classrooms
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage academic sections, assigned instructors, and course details.
            </p>
        </div>

        <button
            type="button"
            onclick="openAddClassModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow transition duration-150 self-start sm:self-auto cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Add Class</span>
        </button>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
            <span class="material-symbols-outlined text-emerald-600 text-[20px]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50/80 border-b border-gray-200/80 text-xs uppercase font-semibold text-gray-500 tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Course & Code</th>
                        <th class="py-3.5 px-6">Section</th>
                        <th class="py-3.5 px-6">Term</th>
                        <th class="py-3.5 px-6">Instructor</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($classes as $class)
                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-700 font-bold text-xs flex items-center justify-center border border-sky-100">
                                        <span class="material-symbols-outlined text-[18px]">menu_book</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 leading-tight">
                                            {{ $class->course_name }}
                                        </p>
                                        <span class="inline-block text-[11px] font-mono font-medium text-sky-700 bg-sky-50 px-2 py-0.5 rounded-md mt-0.5 border border-sky-200/60">
                                            {{ $class->course_code }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6 font-medium text-gray-800">
                                Sec {{ $class->section }}
                            </td>

                            <td class="py-4 px-6 text-xs text-gray-500">
                                <p class="font-medium text-gray-700">{{ $class->semester }}</p>
                                <p class="text-gray-400">{{ $class->academic_year }}</p>
                            </td>

                            <td class="py-4 px-6">
                                @if($class->instructor)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold flex items-center justify-center">
                                            {{ strtoupper(substr($class->instructor->name, 0, 1)) }}
                                        </div>
                                        <span class="text-xs font-semibold text-gray-800">
                                            {{ $class->instructor->name }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">
                                        Unassigned
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('classes.show', $class) }}"
                                       class="px-2.5 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 transition">
                                        View
                                    </a>

                                    <a href="{{ route('classes.edit', $class) }}"
                                       class="px-2.5 py-1.5 rounded-lg text-xs font-medium text-blue-600 hover:bg-blue-50 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this class?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg text-xs font-medium text-red-600 hover:bg-red-50 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400">
                                <span class="material-symbols-outlined text-[36px] text-gray-300 block mb-2">
                                    school
                                </span>
                                No classes found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($classes->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $classes->links() }}
            </div>
        @endif
    </div>

</div>

<!-- =========================================================
    MODAL: CREATE NEW CLASS (BLURRED BACKDROP)
========================================================== -->
<div
    id="addClassModal"
    class="hidden fixed inset-0 z-50 bg-slate-950/50 backdrop-blur-md items-center justify-center p-4 overflow-y-auto animate-fade-in"
    onclick="closeAddClassModalOutside(event)"
>
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100 my-8 transition-all transform duration-200"
        onclick="event.stopPropagation()"
    >
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 bg-gray-50/70">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[20px]">menu_book</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        Create New Class
                    </h2>
                    <p class="text-xs text-gray-500">
                        Configure course section, term, and assign instructor.
                    </p>
                </div>
            </div>

            <button
                type="button"
                onclick="closeAddClassModal()"
                class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-200/60 hover:text-gray-700 transition"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('classes.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="modal_course_code" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Course Code <span class="text-rose-500">*</span>
                </label>
                <input
                    id="modal_course_code"
                    type="text"
                    name="course_code"
                    placeholder="e.g. CS402"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            <div>
                <label for="modal_course_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Course Name <span class="text-rose-500">*</span>
                </label>
                <input
                    id="modal_course_name"
                    type="text"
                    name="course_name"
                    placeholder="e.g. Advanced Software Engineering"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label for="modal_section" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Section <span class="text-rose-500">*</span>
                    </label>
                    <input
                        id="modal_section"
                        type="text"
                        name="section"
                        placeholder="e.g. 1A"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>

                <div>
                    <label for="modal_semester" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <input
                        id="modal_semester"
                        type="text"
                        name="semester"
                        placeholder="e.g. 1st Sem"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>

                <div>
                    <label for="modal_academic_year" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Academic Year <span class="text-rose-500">*</span>
                    </label>
                    <input
                        id="modal_academic_year"
                        type="text"
                        name="academic_year"
                        placeholder="e.g. 2026-2027"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>
            </div>

            <div>
                <label for="modal_Instructor_Id" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Lead Instructor
                </label>
                <select
                    name="Instructor_Id"
                    id="modal_Instructor_Id"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                    <option value="">Choose Instructor (Optional)</option>
                    @foreach($instructorList as $instructor)
                        <option value="{{ $instructor->id }}">
                            {{ $instructor->name }} ({{ $instructor->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button
                    type="button"
                    onclick="closeAddClassModal()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs hover:shadow transition duration-150"
                >
                    Save Class
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openAddClassModal() {
        const modal = document.getElementById('addClassModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeAddClassModal() {
        const modal = document.getElementById('addClassModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    function closeAddClassModalOutside(event) {
        if (event.target === document.getElementById('addClassModal')) {
            closeAddClassModal();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddClassModal();
        }
    });

    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openAddClassModal();
        });
    @endif
</script>
@endpush

@endsection
