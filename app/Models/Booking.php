<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function user()
    {
        return $this->belongsTo(PublicUsers::class);
    }

    public function movie_show()
    {
        return $this->belongsTo(MovieShow::class, 'movie_shows_id');
    }

    // Define a relationship through the 'show' relationship to access the pivot table
    // public function movie()
    // {
    //     return $this->belongsTo(Movie::class)->through(Show::class);
    // }
}
