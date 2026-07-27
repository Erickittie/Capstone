<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassRoom::with('instructor') -> paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = User::where('role', 'Instructor') -> get();

        return view('admin.classes.create', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate ([
            'course_code' => 'required',
            'course_name' => 'required',
            'section' => 'required',
            'semester' => 'required',
            'academic_year' => 'required',
            'Instructor_Id' => 'nullable|exists:users,id'
        ]);

         ClassRoom::create([
            'course_code' => $request -> course_code,
            'course_name' => $request -> course_name,
            'section' => $request -> section,
            'semester' => $request -> semester,
            'academic_year' => $request -> academic_year,
            'Instructor_Id' => $request -> Instructor_Id
        ]);

        return redirect() -> route('classes.index') -> with('success', 'Class created successfully. ');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $class)
    {
        $class -> load('instructor');

        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $class)
    {
        $instructors = User::where('role', 'Instructor') -> get();

        return view('admin.classes.edit', compact('class', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $class)
    {
        $request -> validate([
            'course_code' => 'required',
            'course_name' => 'required',
            'section' => 'required',
            'semester' => 'required',
            'academic_year' => 'required',
            'Instructor_Id' => 'nullable|exists:users,id'
        ]);

        $class -> update([
            'course_code' => $request -> course_code,
            'course_name' => $request -> course_name,
            'section' => $request -> section,
            'semester' => $request -> semester,
            'academic_year' => $request -> academic_year,
            'Instructor_Id' => $request -> Instructor_Id
        ]);

        return redirect() -> route('classes.index') -> with('success', 'Class updated successfully. ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class)
    {
        $class->delete();

        return redirect() -> route('classes.index') -> with('success', "Class deleted successfully. ");
    }
}
