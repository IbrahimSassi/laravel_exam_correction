<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $guarded = [];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
