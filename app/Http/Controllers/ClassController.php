<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{

    public function index()
    {
        $classes = ClassRoom::with('instructor')->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $instructors = User::where('role', 'Instructor')
            ->get();

        return view('admin.classes.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|string|max:50',
            'course_name' => 'required|string|max:255',

            'offer_code' => 'required|string|max:50',

            'semester' => [
                'required',
                Rule::in([
                    '1st Semester',
                    '2nd Semester',
                    'Summer',
                ]),
            ],

            'academic_year' => 'required|string|max:20',

            'Instructor_Id' => 'nullable|exists:users,id',
        ]);

        ClassRoom::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,

            'offer_code' => $request->offer_code,

            'semester' => $request->semester,
            'academic_year' => $request->academic_year,
            'Instructor_Id' => $request->Instructor_Id,
        ]);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function show(ClassRoom $class)
    {
        $class->load('instructor');

        return view('admin.classes.show', compact('class'));
    }

    public function edit(ClassRoom $class)
    {
        $instructors = User::where('role', 'Instructor')
            ->get();

        return view(
            'admin.classes.edit',
            compact('class', 'instructors')
        );
    }

    public function update(Request $request, ClassRoom $class)
    {
        $request->validate([
            'course_code' => 'required|string|max:50',
            'course_name' => 'required|string|max:255',

            'offer_code' => 'required|string|max:50',

            'semester' => [
                'required',
                Rule::in([
                    '1st Semester',
                    '2nd Semester',
                    'Summer',
                ]),
            ],

            'academic_year' => 'required|string|max:20',

            'Instructor_Id' => 'nullable|exists:users,id',
        ]);

        $class->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,

            'offer_code' => $request->offer_code,

            'semester' => $request->semester,
            'academic_year' => $request->academic_year,
            'Instructor_Id' => $request->Instructor_Id,
        ]);

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassRoom $class)
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}