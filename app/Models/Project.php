<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Daabase\Eloquent\Relations\HasMany;

class Project extends Model
{
    //
    protected $fillable = [
        'class_room_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    public function classRoom(): BelongsTo {
        return $this -> belongsto(
            ClassRoom::class,
            'class_room_id'
        );
    }

    public function tasks(): HasMany {
        return $this -> hasMany(
            Task::class,
            'project_id'
        );
    }
}
