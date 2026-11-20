<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shared\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function departments(): array
    {
        return ['SCS', 'SOE', 'SAS', 'SBM'];
    }

    /**
     * Display all users.
     */
    public function index()
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user page.
     */
    public function create()
    {
        $departments = $this->departments();

        return view('admin.users.create', compact('departments'));
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'role' => [
                'required',
                Rule::in(['Admin', 'Instructor', 'Student']),
            ],

            'student_id' => [
                'nullable',
                'required_if:role,Student',
                'string',
                'max:255',
                Rule::unique('users', 'student_id'),
            ],

            'instructor_id' => [
                'nullable',
                'required_if:role,Instructor',
                'string',
                'max:255',
                Rule::unique('users', 'instructor_id'),
            ],

            'department' => [
                'required',
                Rule::in($this->departments()),
            ],

            'status' => [
                'required',
                Rule::in(['Active', 'Inactive']),
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],

            'student_id' => $validated['role'] === 'Student'
                ? $validated['student_id']
                : null,

            'instructor_id' => $validated['role'] === 'Instructor'
                ? $validated['instructor_id']
                : null,

            'department' => $validated['department'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display a specific user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show edit user page.
     */
    public function edit(User $user)
    {
        $departments = $this->departments();

        return view('admin.users.edit', compact('user', 'departments'));
    }

    /**
     * Update existing user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'role' => [
                'required',
                Rule::in(['Admin', 'Instructor', 'Student']),
            ],

            'student_id' => [
                'nullable',
                'required_if:role,Student',
                'string',
                'max:255',
                Rule::unique('users', 'student_id')->ignore($user->id),
            ],

            'instructor_id' => [
                'nullable',
                'required_if:role,Instructor',
                'string',
                'max:255',
                Rule::unique('users', 'instructor_id')->ignore($user->id),
            ],

            'department' => [
                'required',
                Rule::in($this->departments()),
            ],

            'status' => [
                'required',
                Rule::in(['Active', 'Inactive']),
            ],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],

            'student_id' => $validated['role'] === 'Student'
                ? ($validated['student_id'] ?? null)
                : null,

            'instructor_id' => $validated['role'] === 'Instructor'
                ? ($validated['instructor_id'] ?? null)
                : null,

            'department' => $validated['department'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Show password edit page.
     */
    public function editPassword(User $user)
    {
        return view('admin.users.edit-password', compact('user'));
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Password updated successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
