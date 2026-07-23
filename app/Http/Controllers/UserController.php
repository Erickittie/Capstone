<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $requet -> search;

        $users = User::when($search, function($query) use ($search){
            $query -> where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->latest()
        ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
       return view('users.create');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request->password),
            'role' => $request -> role,
            'department' => $request -> department,
            'status' => $request -> status
        ]);

        return redirect() -> route('user.index');
    }

    public function show(User $user)
    {
        return view('user.view', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = update($request -> all());

        return redirect() -> route('user.index');
    }

    public function destroy(User $user)
    {
        $user -> delete();

        return redirect() -> route('user.index');
    }
}
