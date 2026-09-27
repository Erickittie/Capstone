@extends('layouts.student')

@section('title', 'File Repository')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- ============================================================
         HEADER
    ============================================================ --}}

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">

        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a
                    href="{{ route('student.dashboard') }}"
                    class="hover:text-blue-600 transition"
                >
                    Dashboard
                </a>

                <span class="material-symbols-outlined text-[16px]">
                    chevron_right
                </span>

                <span>
                    {{ $class->course_code }}
                </span>

                <span class="material-symbols-outlined text-[16px]">
                    chevron_right
                </span>

                <span class="text-gray-700">
                    File Repository
                </span>
            </div>

            <h1 class="text-2xl font-extrabold text-gray-900">
                Shared File Repository
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Upload, organize, and share files with your group.
            </p>
        </div>

        @if($group && $project)

            <div class="flex items-center gap-3">

                {{-- New Folder --}}

                <button
                    type="button"
                    onclick="openFolderModal()"
                    class="inline-flex items-center gap-2 px-4 py-2.5
                           bg-white border border-gray-200
                           text-gray-700 text-sm font-semibold
                           rounded-xl hover:bg-gray-50
                           transition shadow-sm"
                >
                    <span class="material-symbols-outlined text-[20px]">
                        create_new_folder
                    </span>

                    New Folder
                </button>

                {{-- Upload --}}

                <button
                    type="button"
                    onclick="openUploadModal()"
                    class="inline-flex items-center gap-2 px-4 py-2.5
                           bg-blue-600 text-white text-sm font-semibold
                           rounded-xl hover:bg-blue-700
                           transition shadow-sm"
                >
                    <span class="material-symbols-outlined text-[20px]">
                        upload_file
                    </span>

                    Upload File
                </button>

            </div>

        @endif

    </div>


    {{-- ============================================================
         NO GROUP
    ============================================================ --}}

    @if(!$group)

        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">

            <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-gray-100
                        flex items-center justify-center">

                <span class="material-symbols-outlined text-[32px] text-gray-400">
                    group
                </span>

            </div>

            <h2 class="text-lg font-bold text-gray-900">
                No Group Assigned
            </h2>

            <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                You are not currently assigned to a group for this class.
                Your shared file repository will appear once you join a group.
            </p>

        </div>

    @elseif(!$project)

        {{-- ========================================================
             NO PROJECT
        ========================================================= --}}

        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">

            <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-blue-50
                        flex items-center justify-center">

                <span class="material-symbols-outlined text-[32px] text-blue-600">
                    folder_off
                </span>

            </div>

            <h2 class="text-lg font-bold text-gray-900">
                No Project Available
            </h2>

            <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                Your group does not have a project assigned yet.
                The shared repository will become available once a project is assigned.
            </p>

        </div>

    @else

        {{-- ========================================================
             PROJECT INFORMATION
        ========================================================= --}}

        <div class="bg-white border border-gray-200 rounded-2xl p-5 mb-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl bg-blue-50
                                flex items-center justify-center">

                        <span class="material-symbols-outlined text-[26px] text-blue-600">
                            folder_shared
                        </span>

                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                            Project
                        </p>

                        <h2 class="text-lg font-bold text-gray-900">
                            {{ $project->title }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $group->name }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-6 text-sm">

                    <div>
                        <p class="text-xs text-gray-400">
                            Folders
                        </p>

                        <p class="font-bold text-gray-900">
                            {{ $folders->count() }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400">
                            Files
                        </p>

                        <p class="font-bold text-gray-900">
                            {{ $files->count() }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================
             BREADCRUMB
        ========================================================= --}}

        <div class="flex items-center gap-2 mb-5 text-sm">

            <a
                href="{{ route('student.file.repository', ['classId' => $class->id]) }}"
                class="flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-medium"
            >
                <span class="material-symbols-outlined text-[18px]">
                    folder
                </span>

                {{ $project->title }}
            </a>

            @if($currentFolder)

                <span class="material-symbols-outlined text-[18px] text-gray-400">
                    chevron_right
                </span>

                <span class="font-semibold text-gray-700">
                    {{ $currentFolder->name }}
                </span>

            @endif

        </div>


        {{-- ========================================================
             SEARCH / SORT BAR
        ========================================================= --}}

        <div class="bg-white border border-gray-200 rounded-2xl p-4 mb-5">

            <div class="flex flex-col md:flex-row gap-3 md:items-center">

                <div class="relative flex-1">

                    <span class="material-symbols-outlined absolute left-3 top-1/2
                                 -translate-y-1/2 text-gray-400 text-[20px]">
                        search
                    </span>

                    <input
                        id="repositorySearch"
                        type="text"
                        placeholder="Search files and folders..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl
                               border border-gray-200
                               text-sm outline-none
                               focus:ring-2 focus:ring-blue-100
                               focus:border-blue-400"
                    >

                </div>

                <button
                    type="button"
                    onclick="clearRepositorySearch()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200
                           text-sm font-medium text-gray-600
                           hover:bg-gray-50 transition"
                >
                    Clear
                </button>

            </div>

        </div>


        {{-- ========================================================
             FOLDERS
        ========================================================= --}}

        @if($folders->count())

            <div class="mb-8">

                <div class="flex items-center justify-between mb-3">

                    <h3 class="text-sm font-bold text-gray-900">
                        Folders
                    </h3>

                    <span class="text-xs text-gray-400">
                        {{ $folders->count() }}
                        {{ $folders->count() === 1 ? 'folder' : 'folders' }}
                    </span>

                </div>


                <div
                    id="folderGrid"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                >

                    @foreach($folders as $folder)

                        <div
                            class="repository-item folder-card bg-white border
                                   border-gray-200 rounded-2xl p-4
                                   hover:border-blue-200 hover:shadow-sm
                                   transition"
                            data-name="{{ strtolower($folder->name) }}"
                        >

                            <div class="flex items-start justify-between gap-3">

                                <a
                                    href="{{ route('student.file.repository', [
                                        'classId' => $class->id,
                                        'folder' => $folder->id
                                    ]) }}"
                                    class="flex items-center gap-3 min-w-0 flex-1"
                                >

                                    <div class="w-11 h-11 rounded-xl bg-blue-50
                                                flex items-center justify-center
                                                flex-shrink-0">

                                        <span class="material-symbols-outlined text-[25px] text-blue-600">
                                            folder
                                        </span>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold text-sm text-gray-900 truncate">
                                            {{ $folder->name }}
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $folder->files_count }}
                                            {{ $folder->files_count === 1 ? 'file' : 'files' }}
                                        </p>

                                    </div>

                                </a>


                                {{-- Delete folder --}}

                                <form
                                    action="{{ route('student.file.repository.folder.delete', [
                                        'classId' => $class->id,
                                        'folderId' => $folder->id
                                    ]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this folder and its files?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-8 h-8 rounded-lg
                                               flex items-center justify-center
                                               text-gray-400 hover:text-red-600
                                               hover:bg-red-50 transition"
                                        title="Delete folder"
                                    >

                                        <span class="material-symbols-outlined text-[19px]">
                                            delete
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- ========================================================
             FILES
        ========================================================= --}}

        <div>

            <div class="flex items-center justify-between mb-3">

                <h3 class="text-sm font-bold text-gray-900">
                    Files
                </h3>

                <span class="text-xs text-gray-400">
                    {{ $files->count() }}
                    {{ $files->count() === 1 ? 'file' : 'files' }}
                </span>

            </div>


            @if($files->count())

                <div
                    id="fileList"
                    class="bg-white border border-gray-200 rounded-2xl overflow-hidden"
                >

                    {{-- Table header --}}

                    <div class="hidden md:grid grid-cols-[1fr_150px_150px_100px]
                                gap-4 px-5 py-3
                                bg-gray-50 border-b border-gray-200
                                text-[11px] font-bold uppercase
                                tracking-wide text-gray-400">

                        <div>
                            Name
                        </div>

                        <div>
                            Uploaded By
                        </div>

                        <div>
                            Date
                        </div>

                        <div class="text-right">
                            Action
                        </div>

                    </div>


                    @foreach($files as $file)

                        <div
                            class="repository-item file-row px-5 py-4
                                   border-b border-gray-100 last:border-b-0
                                   hover:bg-gray-50/70 transition"
                            data-name="{{ strtolower($file->original_name) }}"
                        >

                            <div class="grid grid-cols-1 md:grid-cols-[1fr_150px_150px_100px]
                                        gap-3 md:gap-4 items-center">

                                {{-- File name --}}

                                <div class="flex items-center gap-3 min-w-0">

                                    @php
                                        $extension = strtolower(
                                            pathinfo(
                                                $file->original_name,
                                                PATHINFO_EXTENSION
                                            )
                                        );

                                        $icon = match($extension) {
                                            'pdf' => 'picture_as_pdf',
                                            'doc', 'docx' => 'description',
                                            'xls', 'xlsx' => 'table_chart',
                                            'ppt', 'pptx' => 'slideshow',
                                            'zip', 'rar', '7z' => 'folder_zip',
                                            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'image',
                                            'mp4', 'mov', 'avi' => 'movie',
                                            'mp3', 'wav' => 'audio_file',
                                            default => 'insert_drive_file',
                                        };
                                    @endphp

                                    <div class="w-10 h-10 rounded-xl bg-gray-100
                                                flex items-center justify-center
                                                flex-shrink-0">

                                        <span class="material-symbols-outlined text-[22px] text-gray-500">
                                            {{ $icon }}
                                        </span>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold text-sm text-gray-900 truncate">
                                            {{ $file->original_name }}
                                        </p>

                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ strtoupper($extension ?: 'FILE') }}
                                            ·
                                            {{ number_format($file->file_size / 1024, 1) }} KB
                                        </p>

                                    </div>

                                </div>


                                {{-- Uploader --}}

                                <div class="text-sm text-gray-600">

                                    <span class="md:hidden text-xs text-gray-400">
                                        Uploaded by:
                                    </span>

                                    {{ $file->uploader->name ?? 'Unknown' }}

                                </div>


                                {{-- Date --}}

                                <div class="text-sm text-gray-500">

                                    <span class="md:hidden text-xs text-gray-400">
                                        Uploaded:
                                    </span>

                                    {{ $file->created_at->format('M d, Y') }}

                                </div>


                                {{-- Actions --}}

                                <div class="flex md:justify-end items-center gap-2">

                                    <a
                                        href="{{ route('student.file.repository.download', [
                                            'classId' => $class->id,
                                            'fileId' => $file->id
                                        ]) }}"
                                        class="w-9 h-9 rounded-lg
                                               flex items-center justify-center
                                               text-blue-600 bg-blue-50
                                               hover:bg-blue-100 transition"
                                        title="Download"
                                    >

                                        <span class="material-symbols-outlined text-[20px]">
                                            download
                                        </span>

                                    </a>


                                    @if($file->uploaded_by === Auth::id())

                                        <form
                                            action="{{ route('student.file.repository.file.delete', [
                                                'classId' => $class->id,
                                                'fileId' => $file->id
                                            ]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this file?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-9 h-9 rounded-lg
                                                       flex items-center justify-center
                                                       text-red-500 bg-red-50
                                                       hover:bg-red-100 transition"
                                                title="Delete"
                                            >

                                                <span class="material-symbols-outlined text-[20px]">
                                                    delete
                                                </span>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Empty files --}}

                <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center">

                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-gray-100
                                flex items-center justify-center">

                        <span class="material-symbols-outlined text-[28px] text-gray-400">
                            folder_open
                        </span>

                    </div>

                    <h3 class="font-bold text-gray-900">
                        No files yet
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Upload a file to start building your shared repository.
                    </p>

                    <button
                        type="button"
                        onclick="openUploadModal()"
                        class="mt-5 inline-flex items-center gap-2
                               px-4 py-2.5 bg-blue-600 text-white
                               text-sm font-semibold rounded-xl
                               hover:bg-blue-700 transition"
                    >

                        <span class="material-symbols-outlined text-[20px]">
                            upload_file
                        </span>

                        Upload File

                    </button>

                </div>

            @endif

        </div>

    @endif

</div>


{{-- ================================================================
     UPLOAD MODAL
================================================================ --}}

@if($group && $project)

<div
    id="uploadModal"
    class="fixed inset-0 z-50 hidden"
>

    <div
        class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        onclick="closeUploadModal()"
    ></div>

    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl">

            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-gray-900">
                        Upload File
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Add a file to your shared repository.
                    </p>

                </div>

                <button
                    type="button"
                    onclick="closeUploadModal()"
                    class="w-9 h-9 rounded-lg hover:bg-gray-100
                           flex items-center justify-center text-gray-500"
                >

                    <span class="material-symbols-outlined">
                        close
                    </span>

                </button>

            </div>


            <form
                action="{{ route('student.file.repository.upload', [
                    'classId' => $class->id
                ]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <input
                    type="hidden"
                    name="project_id"
                    value="{{ $project->id }}"
                >

                @if($currentFolder)

                    <input
                        type="hidden"
                        name="folder_id"
                        value="{{ $currentFolder->id }}"
                    >

                @endif


                <div class="p-6">

                    <label
                        for="repositoryFile"
                        class="block border-2 border-dashed border-gray-300
                               rounded-2xl p-8 text-center
                               hover:border-blue-400 hover:bg-blue-50/30
                               transition cursor-pointer"
                    >

                        <span class="material-symbols-outlined text-[40px] text-blue-500">
                            cloud_upload
                        </span>

                        <p class="mt-3 font-semibold text-gray-900">
                            Choose a file
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Maximum file size: 50 MB
                        </p>

                        <p
                            id="selectedFileName"
                            class="text-sm text-blue-600 font-medium mt-3 hidden"
                        ></p>

                        <input
                            id="repositoryFile"
                            type="file"
                            name="file"
                            class="hidden"
                            required
                        >

                    </label>

                    <div class="mt-4 p-3 bg-gray-50 rounded-xl">

                        <div class="flex items-center gap-2 text-xs text-gray-500">

                            <span class="material-symbols-outlined text-[18px]">
                                folder
                            </span>

                            <span>
                                Uploading to:
                            </span>

                            <strong class="text-gray-700">
                                {{ $currentFolder ? $currentFolder->name : 'Project Root' }}
                            </strong>

                        </div>

                    </div>

                </div>


                <div class="px-6 py-4 bg-gray-50 rounded-b-2xl
                            flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeUploadModal()"
                        class="px-4 py-2.5 rounded-xl border
                               border-gray-200 text-sm font-semibold
                               text-gray-600 hover:bg-white transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2.5 rounded-xl
                               bg-blue-600 text-white text-sm
                               font-semibold hover:bg-blue-700 transition"
                    >
                        Upload File
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


{{-- ================================================================
     NEW FOLDER MODAL
================================================================ --}}

@if($group && $project)

<div
    id="folderModal"
    class="fixed inset-0 z-50 hidden"
>

    <div
        class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        onclick="closeFolderModal()"
    ></div>

    <div class="relative min-h-screen flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl">

            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-bold text-gray-900">
                        Create Folder
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Organize your shared project files.
                    </p>

                </div>

                <button
                    type="button"
                    onclick="closeFolderModal()"
                    class="w-9 h-9 rounded-lg hover:bg-gray-100
                           flex items-center justify-center text-gray-500"
                >

                    <span class="material-symbols-outlined">
                        close
                    </span>

                </button>

            </div>


            <form
                action="{{ route('student.file.repository.folder', [
                    'classId' => $class->id
                ]) }}"
                method="POST"
            >

                @csrf

                <input
                    type="hidden"
                    name="project_id"
                    value="{{ $project->id }}"
                >

                @if($currentFolder)

                    <input
                        type="hidden"
                        name="parent_id"
                        value="{{ $currentFolder->id }}"
                    >

                @endif


                <div class="p-6">

                    <label
                        for="folderName"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Folder Name
                    </label>

                    <input
                        id="folderName"
                        type="text"
                        name="name"
                        required
                        maxlength="100"
                        placeholder="e.g. Documentation"
                        class="w-full px-4 py-3 rounded-xl
                               border border-gray-200
                               text-sm outline-none
                               focus:ring-2 focus:ring-blue-100
                               focus:border-blue-400"
                    >

                    @if($currentFolder)

                        <p class="text-xs text-gray-400 mt-2">
                            This folder will be created inside
                            <strong class="text-gray-600">
                                {{ $currentFolder->name }}
                            </strong>.
                        </p>

                    @endif

                </div>


                <div class="px-6 py-4 bg-gray-50 rounded-b-2xl
                            flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="closeFolderModal()"
                        class="px-4 py-2.5 rounded-xl border
                               border-gray-200 text-sm font-semibold
                               text-gray-600 hover:bg-white transition"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2.5 rounded-xl
                               bg-blue-600 text-white text-sm
                               font-semibold hover:bg-blue-700 transition"
                    >
                        Create Folder
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


{{-- ================================================================
     JAVASCRIPT
================================================================ --}}

@push('scripts')

<script>

    function openUploadModal() {
        const modal = document.getElementById('uploadModal');

        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeUploadModal() {
        const modal = document.getElementById('uploadModal');

        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }


    function openFolderModal() {
        const modal = document.getElementById('folderModal');

        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            setTimeout(() => {
                const input = document.getElementById('folderName');

                if (input) {
                    input.focus();
                }
            }, 100);
        }
    }

    function closeFolderModal() {
        const modal = document.getElementById('folderModal');

        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | File selection
    |--------------------------------------------------------------------------
    */

    const repositoryFile = document.getElementById('repositoryFile');
    const selectedFileName = document.getElementById('selectedFileName');

    if (repositoryFile) {

        repositoryFile.addEventListener('change', function () {

            if (this.files.length > 0) {

                selectedFileName.textContent =
                    this.files[0].name;

                selectedFileName.classList.remove('hidden');

            } else {

                selectedFileName.textContent = '';

                selectedFileName.classList.add('hidden');

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    const repositorySearch =
        document.getElementById('repositorySearch');

    if (repositorySearch) {

        repositorySearch.addEventListener('input', function () {

            const search =
                this.value.toLowerCase().trim();

            document.querySelectorAll('.repository-item')
                .forEach(function (item) {

                    const name =
                        item.dataset.name || '';

                    item.style.display =
                        name.includes(search)
                            ? ''
                            : 'none';

                });

        });

    }


    function clearRepositorySearch() {

        if (!repositorySearch) {
            return;
        }

        repositorySearch.value = '';

        document.querySelectorAll('.repository-item')
            .forEach(function (item) {
                item.style.display = '';
            });

    }


    /*
    |--------------------------------------------------------------------------
    | ESC closes modals
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            closeUploadModal();
            closeFolderModal();

        }

    });

</script>

@endpush

@endsection