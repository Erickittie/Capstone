<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    public function show($classId)
    {
        $student = Auth::user();

        $class = ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('instructor')
            ->firstOrFail();

        $group = Group::where('class_room_id', $class->id)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->first();

        $projects = collect();

        if ($group) {
            $projects = $group->projects()
                ->where('projects.class_room_id', $class->id)
                ->latest()
                ->get();
        }

        return view(
            'student.class-detail',
            compact(
                'class',
                'student',
                'group',
                'projects'
            )
        );
    }
}