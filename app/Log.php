<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
