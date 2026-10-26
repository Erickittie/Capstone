<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shared\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('student_id', 'like', "%{$search}%")
                      ->orWhere('instructor_id', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in(['Admin', 'Instructor', 'Student'])],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
            'department' => ['nullable', 'string', 'max:255'],

            'student_id' => [
                'nullable',
                'required_if:role,Student',
                'prohibited_unless:role,Student',
                'string',
                'max:255',
                'unique:users,student_id',
            ],

            'instructor_id' => [
                'nullable',
                'required_if:role,Instructor',
                'prohibited_unless:role,Instructor',
                'string',
                'max:255',
                'unique:users,instructor_id',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
            'department' => $validated['department'] ?? null,

            'student_id' => $validated['role'] === 'Student'
                ? $validated['student_id']
                : null,

            'instructor_id' => $validated['role'] === 'Instructor'
                ? $validated['instructor_id']
                : null,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

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
            'role' => ['required', Rule::in(['Admin', 'Instructor', 'Student'])],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
            'department' => ['nullable', 'string', 'max:255'],

            'student_id' => [
                'nullable',
                'required_if:role,Student',
                'prohibited_unless:role,Student',
                'string',
                'max:255',
                Rule::unique('users', 'student_id')->ignore($user->id),
            ],

            'instructor_id' => [
                'nullable',
                'required_if:role,Instructor',
                'prohibited_unless:role,Instructor',
                'string',
                'max:255',
                Rule::unique('users', 'instructor_id')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'department' => $validated['department'] ?? null,

            'student_id' => $validated['role'] === 'Student'
                ? $validated['student_id']
                : null,

            'instructor_id' => $validated['role'] === 'Instructor'
                ? $validated['instructor_id']
                : null,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function editPassword(User $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Password has been reset successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}