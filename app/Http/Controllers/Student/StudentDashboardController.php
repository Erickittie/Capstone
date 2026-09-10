<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $classes = $student->classes()
            ->with('instructor')
            ->latest('class_student.created_at')
            ->get();

        return view('student.dashboard', compact(
            'student',
            'classes'
        ));
    }
}