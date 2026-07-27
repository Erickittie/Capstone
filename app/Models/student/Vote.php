<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    // Fields that are allowed to be saved to the database
    protected $fillable = [
        'voter_id',    
        'candidate_id', 
        'group_id',   
    ];

    // Get the student who cast this vote
    public function voter()
    {
        return $this->belongsTo(User::class, 'voter_id');
    }

    // Get the student who received this vote
    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}