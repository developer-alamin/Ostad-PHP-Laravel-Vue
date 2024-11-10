<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

   public function publisher(){
        return $this->belongsTo(Publisher::class);
   }
}
