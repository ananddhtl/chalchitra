<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    // Define a relationship through the 'show' relationship to access the pivot table
    // public function movie()
    // {
    //     return $this->belongsTo(Movie::class)->through(Show::class);
    // }
}
