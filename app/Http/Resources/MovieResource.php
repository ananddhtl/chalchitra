<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    protected $date;

    public function __construct($resource, $date = null)
    {
        $this->date = $date;
        parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $showTimes = $this->shows()
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
            'id' => "$this->id",
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'iframe_link' => $this->iframe_link,
            'time_duration' => $this->time_duration,
            'category' => $this->movie_category->title,
            'movie_shows' => $showTimes->toArray(),
        ];
    }
}
