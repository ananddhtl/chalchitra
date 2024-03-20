<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieShow extends Model
{
    use HasFactory;

    public function seats()
    {
        return $this->hasMany(Seat::class)->whereDoesntHave('bookings', function ($query) {
            $query->where('movie_shows_id', $this->id);
        });
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
