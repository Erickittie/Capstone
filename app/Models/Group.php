<?php

namespace App\Models;

use App\Models\Student\GroupLeaderVote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'class_room_id',
        'name',
        'group_number',
    ];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(
            ClassRoom::class,
            'class_room_id'
        );
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'group_members',
            'group_id',
            'student_id'
        )
        ->withPivot('is_leader')
        ->withTimestamps();
    }

    public function leaderVotes(): HasMany
    {
        return $this->hasMany(
            GroupLeaderVote::class,
            'group_id'
        );
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_groups',
            'group_id',
            'project_id'
        )->withTimestamps();
    }
}