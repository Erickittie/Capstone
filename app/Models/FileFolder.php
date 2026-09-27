<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'group_id',
        'project_id',
        'parent_id',
        'name',
        'created_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Class
    |--------------------------------------------------------------------------
    */

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(
            ClassRoom::class,
            'class_room_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Group
    |--------------------------------------------------------------------------
    */

    public function group(): BelongsTo
    {
        return $this->belongsTo(
            Group::class,
            'group_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Project
    |--------------------------------------------------------------------------
    */

    public function project(): BelongsTo
    {
        return $this->belongsTo(
            Project::class,
            'project_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Creator
    |--------------------------------------------------------------------------
    */

    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Parent Folder
    |--------------------------------------------------------------------------
    */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            FileFolder::class,
            'parent_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Child Folders
    |--------------------------------------------------------------------------
    */

    public function children(): HasMany
    {
        return $this->hasMany(
            FileFolder::class,
            'parent_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Files
    |--------------------------------------------------------------------------
    */

    public function files(): HasMany
    {
        return $this->hasMany(
            File::class,
            'folder_id'
        );
    }
}