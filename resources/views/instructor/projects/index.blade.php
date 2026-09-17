@extends('layouts.instructor')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">

        {{-- Back Button --}}
        <a
            href="{{ route('instructor.class.configure', $class->id) }}"
            class="w-10 h-10 flex items-center justify-center rounded-xl
                   border border-gray-200 bg-white text-gray-500
                   hover:text-gray-900 hover:border-gray-300 hover:bg-gray-50
                   shadow-xs transition duration-150"
            title="Back to Class"
        >
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>

        <div class="flex-1">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Projects
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Manage projects for {{ $class->course_code }} &mdash; {{ $class->section }}
            </p>
        </div>

        {{-- Create Project Button (shown when projects exist) --}}
        @if($projects->count())
            <button
                type="button"
                onclick="openCreateProjectModal()"
                class="inline-flex items-center gap-2 px-5 py-2.5
                       bg-purple-600 text-white rounded-xl
                       font-semibold text-sm
                       hover:bg-purple-700 active:scale-95
                       shadow-sm hover:shadow-md transition duration-150"
            >
                <span class="material-symbols-outlined text-[18px]">add</span>
                Create Project
            </button>
        @endif

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-emerald-50
                    border border-emerald-200 text-emerald-800 text-sm">
            <span class="material-symbols-outlined text-emerald-500 text-[20px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-red-50
                    border border-red-200 text-red-700 text-sm">
            <span class="material-symbols-outlined text-red-400 text-[20px]">error</span>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif


    {{-- Projects --}}
    @if($projects->count())

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($projects as $project)

                <div class="bg-white rounded-2xl border border-gray-200/80
                            p-6 hover:shadow-md hover:border-gray-300 transition duration-200 flex flex-col">

                    {{-- Project Title & Status --}}
                    <div class="flex items-start justify-between gap-4">

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600
                                        flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[22px]">assignment</span>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-gray-900 leading-tight">
                                    {{ $project->title }}
                                </h2>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $class->course_code }}
                                </p>
                            </div>
                        </div>

                        {{-- Status Badge --}}
                        <span
                            class="shrink-0 px-2.5 py-1 rounded-full text-xs font-semibold
                            @if($project->status === 'Active')
                                bg-emerald-50 text-emerald-700 border border-emerald-200
                            @elseif($project->status === 'Completed')
                                bg-blue-50 text-blue-700 border border-blue-200
                            @else
                                bg-gray-100 text-gray-600 border border-gray-200
                            @endif"
                        >
                            {{ $project->status }}
                        </span>

                    </div>


                    {{-- Description --}}
                    <div class="mt-4 flex-1">

                        @if($project->description)
                            <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        @else
                            <p class="text-sm text-gray-400 italic">
                                No description provided.
                            </p>
                        @endif

                    </div>


                    {{-- Dates --}}
                    <div class="mt-5 pt-4 border-t border-gray-100 space-y-2 text-xs">

                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-gray-500 font-medium">
                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                Start Date
                            </span>
                            <span class="font-semibold text-gray-700">
                                {{ $project->start_date
                                    ? $project->start_date->format('M d, Y')
                                    : 'Not set'
                                }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-gray-500 font-medium">
                                <span class="material-symbols-outlined text-[14px]">event</span>
                                End Date
                            </span>
                            <span class="font-semibold text-gray-700">
                                {{ $project->end_date
                                    ? $project->end_date->format('M d, Y')
                                    : 'Not set'
                                }}
                            </span>
                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="mt-4 flex items-center gap-2">

                        <a
                            href="{{ route(
                                'instructor.projects.edit',
                                [
                                    'classId' => $class->id,
                                    'projectId' => $project->id
                                ]
                            ) }}"
                            class="flex-1 text-center px-4 py-2 rounded-lg
                                   border border-gray-200 text-gray-700
                                   text-sm font-medium
                                   hover:bg-gray-50 hover:border-gray-300 transition"
                        >
                            Edit
                        </a>


                        <form
                            method="POST"
                            action="{{ route(
                                'instructor.projects.destroy',
                                [
                                    'classId' => $class->id,
                                    'projectId' => $project->id
                                ]
                            ) }}"
                            class="flex-1"
                            onsubmit="return confirm(
                                'Are you sure you want to delete this project?'
                            );"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-full px-4 py-2 rounded-lg
                                       bg-red-50 text-red-600 border border-red-100
                                       text-sm font-medium hover:bg-red-100 hover:border-red-200
                                       transition"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Empty State --}}
        <div class="bg-white rounded-2xl border border-gray-200/80
                    p-16 text-center shadow-xs">

            <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-400
                        flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[36px]">folder_open</span>
            </div>

            <h2 class="text-lg font-bold text-gray-900">
                No projects yet
            </h2>

            <p class="text-sm text-gray-500 mt-2 max-w-xs mx-auto leading-relaxed">
                Create the first project for this class to get started.
            </p>

            <button
                type="button"
                onclick="openCreateProjectModal()"
                class="inline-flex items-center gap-2 mt-6 px-5 py-2.5
                       bg-purple-600 text-white rounded-xl
                       text-sm font-semibold
                       hover:bg-purple-700 active:scale-95
                       shadow-sm hover:shadow-md transition duration-150"
            >
                <span class="material-symbols-outlined text-[18px]">add</span>
                Create Project
            </button>

        </div>

    @endif


</div>


{{-- =====================================================
    CREATE PROJECT MODAL
====================================================== --}}
<div
    id="createProjectModal"
    class="hidden fixed inset-0 z-50 bg-black/40 backdrop-blur-sm
           flex items-center justify-center p-4"
    onclick="closeCreateProjectModalOutside(event)"
>
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl
               overflow-hidden border border-gray-200
               max-h-[90vh] flex flex-col"
        onclick="event.stopPropagation()"
    >

        {{-- Modal Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 shrink-0">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Create Project</h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    New project for {{ $class->course_code }} &mdash; {{ $class->section }}
                </p>
            </div>
            <button
                type="button"
                onclick="closeCreateProjectModal()"
                class="w-8 h-8 rounded-lg flex items-center justify-center
                       text-gray-400 hover:bg-gray-100 hover:text-gray-700 transition"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mx-6 mt-5 p-4 rounded-xl bg-red-50 border border-red-200 shrink-0">
                <p class="font-semibold text-red-700 text-sm mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside text-xs text-red-600 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Modal Body (scrollable) --}}
        <div class="overflow-y-auto flex-1 p-6">
            <form
                id="createProjectForm"
                method="POST"
                action="{{ route('instructor.projects.store', $class->id) }}"
                class="space-y-5"
            >
                @csrf

                {{-- Project Title --}}
                <div>
                    <label for="modal_title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Project Title <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="modal_title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="e.g. Online Library System"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm
                               focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none
                               transition"
                    >
                </div>

                {{-- Description --}}
                <div>
                    <label for="modal_description" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Project Description
                    </label>
                    <textarea
                        id="modal_description"
                        name="description"
                        rows="4"
                        placeholder="Describe the project goals and scope..."
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm
                               focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none
                               transition resize-none"
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Dates --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="modal_start_date" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Start Date
                        </label>
                        <input
                            type="date"
                            id="modal_start_date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm
                                   focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none
                                   transition"
                        >
                    </div>
                    <div>
                        <label for="modal_end_date" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            End Date
                        </label>
                        <input
                            type="date"
                            id="modal_end_date"
                            name="end_date"
                            value="{{ old('end_date') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm
                                   focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none
                                   transition"
                        >
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label for="modal_status" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Status
                    </label>
                    <select
                        id="modal_status"
                        name="status"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm
                               focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none
                               transition"
                    >
                        <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Draft" {{ old('status') === 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                {{-- Assign to Groups --}}
                <div>
                    <div class="mb-3">
                        <h3 class="text-sm font-bold text-gray-800">Assign to Groups</h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Select the groups that will work on this project.
                        </p>
                    </div>

                    <div class="space-y-3">
                        @forelse($groups as $group)
                            <label
                                class="flex items-start gap-3 p-4 rounded-xl
                                       border border-gray-200
                                       hover:bg-purple-50 hover:border-purple-300
                                       cursor-pointer transition"
                            >
                                <input
                                    type="checkbox"
                                    name="groups[]"
                                    value="{{ $group->id }}"
                                    {{ in_array($group->id, old('groups', [])) ? 'checked' : '' }}
                                    class="mt-0.5 w-4 h-4 text-purple-600
                                           border-gray-300 rounded focus:ring-purple-500"
                                >
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-sm font-semibold text-gray-800">
                                            {{ $group->name }}
                                        </h4>
                                        <span class="text-xs text-gray-400 shrink-0">
                                            {{ $group->students->count() }} member(s)
                                        </span>
                                    </div>

                                    <div class="mt-1.5 flex flex-wrap gap-1.5">
                                        @forelse($group->students as $student)
                                            <span
                                                class="px-2 py-0.5 text-xs rounded-full
                                                       bg-gray-100 text-gray-600"
                                            >
                                                {{ $student->name }}
                                                @if($student->pivot->is_leader)
                                                    <span class="font-semibold text-purple-600">(Leader)</span>
                                                @endif
                                            </span>
                                        @empty
                                            <span class="text-xs text-red-400">No members assigned</span>
                                        @endforelse
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-amber-500 text-[18px]">warning</span>
                                    <p class="text-sm font-semibold text-amber-800">No groups available.</p>
                                </div>
                                <p class="text-xs text-amber-700 mt-1 ml-6">
                                    Please create student groups before assigning a project.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </form>
        </div>

        {{-- Modal Footer --}}
        <div class="flex items-center justify-end gap-3 px-6 py-4
                    border-t border-gray-100 bg-gray-50/50 shrink-0">
            <button
                type="button"
                onclick="closeCreateProjectModal()"
                class="px-4 py-2 rounded-xl border border-gray-200
                       text-sm font-semibold text-gray-700
                       hover:bg-gray-100 transition"
            >
                Cancel
            </button>
            <button
                type="submit"
                form="createProjectForm"
                class="px-5 py-2 rounded-xl bg-purple-600 text-white
                       text-sm font-semibold
                       hover:bg-purple-700 active:scale-95
                       shadow-sm hover:shadow transition duration-150"
            >
                Create Project
            </button>
        </div>

    </div>
</div>


@push('scripts')
<script>

function openCreateProjectModal() {
    const modal = document.getElementById('createProjectModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeCreateProjectModal() {
    const modal = document.getElementById('createProjectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

function closeCreateProjectModalOutside(event) {
    if (event.target === document.getElementById('createProjectModal')) {
        closeCreateProjectModal();
    }
}

// Auto-open modal if there are validation errors (form was submitted)
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function () {
        openCreateProjectModal();
    });
@endif

</script>
@endpush

@endsection