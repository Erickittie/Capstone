
@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                User Management
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage student, instructor, and administrative system accounts.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button
                type="button"
                onclick="openAddUserModal()"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs transition">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                Add User
            </button>

            <a
                href="{{ route('admin.users.bulk-register') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold shadow-xs transition">
                <span class="material-symbols-outlined text-[18px]">upload_file</span>
                Bulk Registration
            </a>
        </div>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('users.index') }}" class="w-full max-w-md">
        <input
            type="text"
            name="search"
            placeholder="Search by name, email, or role..."
            value="{{ request('search') }}"
            class="w-full h-10 px-4 text-sm rounded-xl border border-gray-200 bg-white">
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
            <p class="font-semibold text-sm mb-2">
                Please correct the following errors:
            </p>

            <ul class="list-disc pl-5 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 border-b text-xs uppercase font-semibold text-gray-500">
                    <tr>
                        <th class="py-3.5 px-6">User</th>
                        <th class="py-3.5 px-6">Role</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                {{ $user->role }}
                            </td>

                            <td class="py-4 px-6">
                                <span class="text-xs font-medium text-emerald-700">
                                    {{ $user->status ?? 'Active' }}
                                </span>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('users.show', $user) }}"
                                       class="text-xs text-gray-600 hover:text-blue-600">
                                        View
                                    </a>

                                    <a href="{{ route('users.edit', $user) }}"
                                       class="text-xs text-blue-600 hover:text-blue-800">
                                        Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-xs text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>

<!-- ADD USER MODAL -->
<div
    id="addUserModal"
    class="hidden fixed inset-0 z-50 bg-slate-950/50 backdrop-blur-md items-center justify-center p-4 overflow-y-auto"
    onclick="closeAddUserModalOutside(event)">

    <div
        class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden my-8"
        onclick="event.stopPropagation()">

        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b bg-gray-50">
            <div>
                <h2 class="text-base font-bold text-gray-900">
                    Add New User
                </h2>
                <p class="text-xs text-gray-500">
                    Create user credentials and assign roles.
                </p>
            </div>

            <button type="button" onclick="closeAddUserModal()"
                    class="text-gray-500 hover:text-gray-900">
                ✕
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-xs font-semibold mb-1.5">Full Name *</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Jane Doe"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200"
                    required>
            </div>

            <!-- Email and Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold mb-1.5">Academic Email *</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="name@usjr.edu.ph"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200"
                        required>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5">Password *</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Min. 8 characters"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200"
                        required>
                </div>
            </div>

            <!-- Role and Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold mb-1.5">Role *</label>

                    <select
                        name="role"
                        id="modal_user_role"
                        onchange="toggleModalIdFields(this.value)"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200"
                        required>

                        <option value="">Choose Role</option>

                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Instructor" {{ old('role') == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                        <option value="Student" {{ old('role') == 'Student' ? 'selected' : '' }}>Student</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5">Status *</label>

                    <select
                        name="status"
                        class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200"
                        required>

                        <option value="Active" {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Student ID -->
            <div id="modal_student_id_container" class="hidden">
                <label class="block text-xs font-semibold mb-1.5">Student ID Number *</label>
                <input
                    type="text"
                    name="student_id"
                    id="modal_user_student_id"
                    value="{{ old('student_id') }}"
                    placeholder="e.g. 2026-0001"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200">
            </div>

            <!-- Instructor ID -->
            <div id="modal_instructor_id_container" class="hidden">
                <label class="block text-xs font-semibold mb-1.5">Instructor ID Number *</label>
                <input
                    type="text"
                    name="instructor_id"
                    id="modal_user_instructor_id"
                    value="{{ old('instructor_id') }}"
                    placeholder="Enter instructor ID number"
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200">
            </div>

            <!-- Department -->
            <div>
                <label class="block text-xs font-semibold mb-1.5">Department *</label>

                <select
                    name="department"
                    required
                    class="w-full h-10 px-3.5 text-sm rounded-xl border border-gray-200">

                    <option value="">Select Department</option>

                    @foreach(['SCS', 'SOE', 'SAS', 'SBM'] as $department)
                        <option value="{{ $department }}"
                            {{ old('department') == $department ? 'selected' : '' }}>
                            {{ $department }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t">
                <button
                    type="button"
                    onclick="closeAddUserModal()"
                    class="px-4 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold">
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

            toggleModalIdFields(
                document.getElementById('modal_user_role').value
            );
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

    function toggleModalIdFields(role) {
        const studentContainer = document.getElementById('modal_student_id_container');
        const studentInput = document.getElementById('modal_user_student_id');

        const instructorContainer = document.getElementById('modal_instructor_id_container');
        const instructorInput = document.getElementById('modal_user_instructor_id');

        const isStudent = role === 'Student';
        const isInstructor = role === 'Instructor';

        studentContainer.classList.toggle('hidden', !isStudent);
        studentInput.required = isStudent;
        studentInput.disabled = !isStudent;

        instructorContainer.classList.toggle('hidden', !isInstructor);
        instructorInput.required = isInstructor;
        instructorInput.disabled = !isInstructor;
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAddUserModal();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const role = document.getElementById('modal_user_role').value;
        toggleModalIdFields(role);

        @if($errors->any())
            openAddUserModal();
        @endif
    });
</script>
@endpush

@endsection
