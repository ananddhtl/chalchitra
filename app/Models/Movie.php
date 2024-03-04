<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $with = ['movie_category'];

    public function movie_category()
    {
        return $this->belongsTo(MovieCategory::class, 'category', 'id');
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class, 'movie_shows')->withPivot('date');
    }
}
