<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'group_id',
        'project_id',
        'folder_id',
        'uploaded_by',
        'name',
        'original_name',
        'file_path',
        'file_type',
        'file_size',
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
    | Folder
    |--------------------------------------------------------------------------
    */

    public function folder(): BelongsTo
    {
        return $this->belongsTo(
            FileFolder::class,
            'folder_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Uploader
    |--------------------------------------------------------------------------
    */

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by'
        );
    }
}