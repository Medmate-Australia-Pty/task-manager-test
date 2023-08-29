<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
    protected $fillable = [
        'user_id', 'title', 'description', 'due_date', 'status',
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];
}
