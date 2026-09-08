<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Task extends Model
{
    //
    protected $fillable = [
        'project_id',
        'group_id',
        'title',
        'description',
        'points',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project(): BelongsTo {
        return $this -> belongsTo(
            Project::class,
            'project_id'
        );
    }

    public function group(): BelongsTo {
        return $this -> belongsTo (
            Group::class,
            'group_id'
        );
    }

    public function assignments(): HasMany {
        return $this -> hasMany (
            TaskAssignment::class,
            'task_id'
        );
    }

    public function submissions(): HasMany {
        return $this -> hasMany (
            TaskSubmission::class,
            'task_id'
        );
    }
}
