<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function instructor(): BelongsTo {
        
        return $this->belongsTo(User::class, 'Instructor_Id', 'id');
    }

    public function students(): BelongsToMany {
        return $this -> belongsToMany (
            User::class,
            'class_student',
            'class_room_id',
            'student_id'
        ) -> withTimestamps();
    }

    public function groups(): HasMany {
        return $this -> hasMany(
            Group::class,
            'class_room_id'
        );
    }
}
