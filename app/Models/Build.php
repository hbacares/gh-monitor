<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $fillable = [
        'repository_id', 'workflow_name', 'status', 'conclusion',
        'started_at', 'completed_at', 'run_id'
    ];

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }
}