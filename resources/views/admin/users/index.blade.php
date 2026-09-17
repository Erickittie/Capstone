@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                User Management
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage student, instructor, and administrative system accounts.
            </p>
        </div>

        <button
            type="button"
            onclick="openAddUserModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs hover:shadow transition duration-150 self-start sm:self-auto cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            <span>Add User</span>
        </button>
    </div>

    <!-- Toolbar: Search -->
    <div class="flex items-center justify-between gap-4">
        <form method="GET" action="{{ route('users.index') }}" class="w-full max-w-md">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px] pointer-events-none">
                    search
                </span>
                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email, or role..."
                    class="w-full h-10 pl-10 pr-4 text-sm rounded-xl border border-gray-200 bg-white placeholder-gray-400 text-gray-800 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100/60 shadow-xs transition"
                    value="{{ request('search') }}"
                >
            </div>
        </form>
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
                        <th class="py-3.5 px-6">User</th>
                        <th class="py-3.5 px-6">Role</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center border border-slate-200">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 leading-tight">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                @if($user->role === 'Admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                        Admin
                                    </span>
                                @elseif($user->role === 'Instructor')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        Instructor
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Student
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $user->status ?? 'Active' }}
                                </span>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('users.show', $user) }}"
                                       class="px-2.5 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 transition">
                                        View
                                    </a>

                                    <a href="{{ route('users.edit', $user) }}"
                                       class="px-2.5 py-1.5 rounded-lg text-xs font-medium text-blue-600 hover:bg-blue-50 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                            <td colspan="4" class="py-12 text-center text-gray-400">
                                <span class="material-symbols-outlined text-[36px] text-gray-300 block mb-2">
                                    person_off
                                </span>
                                No users found matching the query.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>

<!-- =========================================================
    MODAL: ADD USER (BLURRED BACKDROP)
========================================================== -->
<div
    id="addUserModal"
    class="hidden fixed inset-0 z-50 bg-slate-950/50 backdrop-blur-md items-center justify-center p-4 overflow-y-auto animate-fade-in"
    onclick="closeAddUserModalOutside(event)"
>
    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100 my-8 transition-all transform duration-200"
        onclick="event.stopPropagation()"
    >
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 bg-gray-50/70">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-900">
                        Add New User
                    </h2>
                    <p class="text-xs text-gray-500">
                        Create user credentials and assign roles.
                    </p>
                </div>
            </div>

            <button
                type="button"
                onclick="closeAddUserModal()"
                class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-gray-200/60 hover:text-gray-700 transition"
            >
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="modal_user_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Full Name <span class="text-rose-500">*</span>
                </label>
                <input
                    id="modal_user_name"
                    type="text"
                    name="name"
                    placeholder="e.g. Jane Doe"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                    required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="modal_user_email" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Academic Email <span class="text-rose-500">*</span>
                    </label>
                    <input
                        id="modal_user_email"
                        type="email"
                        name="email"
                        placeholder="name@usjr.edu.ph"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>

                <div>
                    <label for="modal_user_password" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Password <span class="text-rose-500">*</span>
                    </label>
                    <input
                        id="modal_user_password"
                        type="password"
                        name="password"
                        placeholder="Min. 8 characters"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="modal_user_role" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Role <span class="text-rose-500">*</span>
                    </label>
                    <select
                        name="role"
                        id="modal_user_role"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required
                        onchange="toggleModalStudentId(this.value)">
                        <option value="">Choose Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Instructor">Instructor</option>
                        <option value="Student">Student</option>
                    </select>
                </div>

                <div>
                    <label for="modal_user_status" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select
                        name="status"
                        id="modal_user_status"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                        required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div id="modal_student_id_container" class="hidden">
                <label for="modal_user_student_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Student ID Number <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="student_id"
                    id="modal_user_student_id"
                    placeholder="e.g. 2026-0001"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
            </div>

            <div>
                <label for="modal_user_department" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-1.5">
                    Department
                </label>
                <input
                    id="modal_user_department"
                    type="text"
                    name="department"
                    placeholder="e.g. Computer Science"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button
                    type="button"
                    onclick="closeAddUserModal()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs hover:shadow transition duration-150"
                >
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openAddUserModal() {
        const modal = document.getElementById('addUserModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeAddUserModal() {
        const modal = document.getElementById('addUserModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    function closeAddUserModalOutside(event) {
        if (event.target === document.getElementById('addUserModal')) {
            closeAddUserModal();
        }
    }

    function toggleModalStudentId(role) {
        const container = document.getElementById('modal_student_id_container');
        const input = document.getElementById('modal_user_student_id');
        if (container) {
            if (role === 'Student') {
                container.classList.remove('hidden');
                if (input) input.required = true;
            } else {
                container.classList.add('hidden');
                if (input) {
                    input.required = false;
                    input.value = '';
                }
            }
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddUserModal();
        }
    });

    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openAddUserModal();
        });
    @endif
</script>
@endpush

@endsection
