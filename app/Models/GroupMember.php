<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupMember extends Model
{
    //
    protected $fillable = [
        'group_id',
        'student_id',
        'is_leader'
    ];

    protected $casts = [
        'is_leader' => 'boolean',
    ];

    public function group(): BelongsTo {
        return $this -> belongsTo (
            Group::class,
            'gour_id'
        );
    }

    public function student(): BelongsTo {
        return $this -> belongsTo (
            User::class,
            'student_id'
        );
    }
}
