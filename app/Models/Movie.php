<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $with = ['movie_category', 'shows'];

    public function scopeAvailableOn($query, $date)
    {
        return $query->where('publish_date', '<=', $date)
            ->where('end_date', '>=', $date);
    }

    public function movie_category()
    {
        return $this->belongsTo(MovieCategory::class, 'category', 'id');
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class, 'movie_shows', 'movie_id', 'show_id')->withPivot('movie_date');
    }
}
