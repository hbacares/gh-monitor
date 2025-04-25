<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $fillable = ['event_type', 'payload'];

    protected $casts = [
        'payload' => 'array',
    ];
}