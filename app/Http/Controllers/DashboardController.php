<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClassRoom;

class DashboardController extends Controller
{
    public function index() {

        return view('admin.dashboard.index', [
            'users' => User::count(),
            'classes' => ClassRoom::count(),
            'reports' => 0,
            'instructors' => User::where('role', 'Instructor') -> count()
        ]);
    }
}
