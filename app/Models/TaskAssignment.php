<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsTo;

class TaskAssignment extends Model
{
    //
    protected $fillable = [
        'task_id',
        'student_id',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function task(): BelongsTo {
        return $this -> belongsTo (
            Task::class,
            'task_id'
        );
    }

    public function student(): BelongsTo {
        return $this -> belongsTo (
            User::class,
            'student_id'
        );
    }
}
