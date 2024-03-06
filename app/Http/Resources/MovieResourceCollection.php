<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieResourceCollection extends ResourceCollection
{
    protected $date;

    public function __construct($resource, $date = null)
    {
        $this->date = $date;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($movie) {
            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'description' => $movie->description,
                'thumbnail' => $movie->thumbnail,
                'iframe_link' => $movie->iframe_link,
                'time_duration' => $movie->time_duration,
                'category' => $movie->movie_category->title,
                'show_time' => $movie->shows()->wherePivot('movie_date', $this->date)->pluck('show_time')->toArray()
            ];
        })->all();
    }
}
