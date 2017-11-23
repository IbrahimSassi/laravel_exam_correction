<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
