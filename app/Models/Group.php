<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    //
    protected $fillable = [
        'class_room_id',
        'name',
        'group_number',
    ];

    public function classRoom(): BelongsTo {
        return $this -> belongsTo(
            ClassRoom::class,
            'class_room_id'
        );
    }

    public function students() : BelongsToMany {
        return $this -> belongsToMany(
            User::class,
            'group_members',
            'group_id',
            'student_id'
        )
        -> withPivot('is_leader')
        -> withTimestamps();
    }
}
