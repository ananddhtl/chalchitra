<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $appends = ['seat_available'];

    public function movie_show()
    {
        return $this->belongsTo(MovieShow::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
