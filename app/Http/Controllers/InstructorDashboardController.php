<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    //
    public function index() {
        $classes = Classroom::where('Instructor_Id', Auth::id())
        -> latest()
        ->get();

        return view('instructor.dashboard', compact('classes'));
    }
}
