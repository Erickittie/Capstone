<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department',
        'status',
        'student_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function instructorClasses(): HasMany
    {
        return $this->hasMany(
            ClassRoom::class,
            'Instructor_Id'
        );
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(
            ClassRoom::class,
            'class_student',
            'student_id',
            'class_room_id'
        )->withTimestamps();
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'group_members',
            'student_id',
            'group_id'
        )
        ->withPivot('is_leader')
        ->withTimestamps();
    }
}