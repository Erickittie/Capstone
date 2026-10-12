<?php

namespace App\Http\Controllers\Student;

use App\Models\Student\CheckinRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckinRequestController extends Controller
{
    // Show the check-in request page with the student's past requests
    // Show the check-in request page with the student's past requests
    public function index($classId)
    {
        $studentId = auth()->id();

        // 1. Fetch the class record
        $class = \App\Models\shared\ClassRoom::where('id', $classId)
            ->whereHas('students', function ($query) use ($studentId) {
                $query->where('users.id', $studentId);
            })
            ->firstOrFail();

        // Get all requests made by the logged-in student for this class, newest first
        $requests = CheckinRequest::where('student_id', $studentId)
            ->where('class_room_id', $classId)
            ->latest()
            ->get();

        return view('student.checkin-schedule', compact('class', 'requests'));
    }

    // Save a new check-in request to the database
    public function store(Request $request)
    {
        // Validate the form fields before saving
        $request->validate([
            'class_room_id'  => 'required|exists:class_rooms,id',
            'reason'         => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required',
            'mode'           => 'required|in:in-person,online,either',
            'message'        => 'nullable|string|max:500',
        ]);

        // Create and save the new request
        CheckinRequest::create([
            'student_id'     => auth()->id(), // automatically use logged-in student's id
            'class_room_id'  => $request->class_room_id,
            'reason'         => $request->reason,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'mode'           => $request->mode,
            'message'        => $request->message,
            'status'         => 'pending', // always starts as pending
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Check-in request submitted successfully.');
    }
}