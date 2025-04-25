<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = ['user_id', 'github_id', 'name', 'full_name', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function builds()
    {
        return $this->hasMany(Build::class);
    }
}