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

            $showTimes = $movie->shows()
                ->wherePivot('movie_date', $this->date)
                ->select('movie_shows.id', 'show_id', 'show_time')
                ->get()
                ->map(function ($show) {
                    return [
                        'id' => "$show->id",
                        'show_time' => $show->show_time
                    ];
                });

            return [
                'id' => "$movie->id",
                'title' => $movie->title,
                'description' => $movie->description,
                'thumbnail' => $movie->thumbnail,
                'iframe_link' => $movie->iframe_link,
                'time_duration' => $movie->time_duration,
                'category' => $movie->movie_category->title ?? null,
                'movie_shows' => $showTimes->toArray(),
            ];
        })->all();
    }
}
