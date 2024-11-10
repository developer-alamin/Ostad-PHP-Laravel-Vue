<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = "Publisher";

    protected $fillable = ["name","address","email","founded_year"];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
