<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    //
    protected $fillable = [
        'course_code',
        'course_name',
        'section',
        'semester',
        'academic_year',
        'Instructor_Id'
    ];

    public function instructor() {
        
        return $this->belongsTo(User::class, 'Instructor_Id', 'id');
    }
}
