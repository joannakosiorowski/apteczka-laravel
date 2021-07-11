<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Content extends Model
{
     protected $guarded = [];

     public function drugstore()
     {
         return $this->belongsTo(Drugstore::class);
     }

     public function medicine()
     {
         return $this->belongsTo(Medicine::class);
     }


}
