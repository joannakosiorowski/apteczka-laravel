<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{User};

class Drugstore extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
