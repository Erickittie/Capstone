<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinRequest extends Model
{
    // Fields that are allowed to be saved to the database
    protected $fillable = [
        'student_id',      // the student who made the request
        'class_room_id',   // which class the request is for
        'reason',          // reason for the check-in
        'preferred_date',  // student's preferred meeting date
        'preferred_time',  // student's preferred meeting time
        'mode',            // in-person, online, or either
        'message',         // optional additional message from student
        'status',          // pending, approved, or declined
        'instructor_note', // optional note from instructor
    ];

    // Get the student who made this request
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Get the class this request belongs to
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }
}