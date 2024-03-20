<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MyBookingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($booking) {

            return [
                'id' => $booking->id,
                'movie_name' => $booking->movie_show->movie->title,
                'movie_image' => $booking->movie_show->movie->thumbnail,
                'booked_date' => $booking->booking_date,
            ];
        })->all();
    }
}
