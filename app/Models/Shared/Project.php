<?php

namespace App\Models\Shared;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'class_room_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'contribution_threshold',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'contribution_threshold' => 'decimal:2',
    ];

    public function isUpcoming(): bool
    {
        if (!$this->start_date) {
            return false;
        }

        return $this->start_date->format('Y-m-d') > now()->format('Y-m-d');
    }

    public function isAccessible(): bool
    {
        return !$this->isUpcoming();
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(
            ClassRoom::class,
            'class_room_id'
        );
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'project_groups',
            'project_id',
            'group_id'
        )->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(
            Task::class,
            'project_id'
        );
    }

    public function fileFolders(): HasMany
    {
    return $this->hasMany(
        FileFolder::class,
        'project_id'
    );
    }

    public function files(): HasMany
    {
    return $this->hasMany(
        File::class,
        'project_id'
    );
}
}