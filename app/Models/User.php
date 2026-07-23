<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable {

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department',
        'status',
    ];

    protected $hidden = [
        'password'
    ];
}