<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Shared\User;
use App\Models\Shared\ClassRoom;

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
