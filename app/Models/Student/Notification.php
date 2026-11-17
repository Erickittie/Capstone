<?php

namespace App\Models\Student;

use App\Models\Shared\Task;
use App\Models\Shared\TaskSubmission;
use App\Models\Shared\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'task_id',
        'submission_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(\App\Models\Shared\Task::class);
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(TaskSubmission::class);
    }
}