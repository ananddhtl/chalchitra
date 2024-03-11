<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MovieShow;
use App\Models\Seat;
use Exception;
use Illuminate\Http\Request;

class SeatController extends BaseApiController
{
    public function seatAvailability(Request $request)
    {
        try {
            $movie_shows_id = $request->movie_shows_id;
            $movie_shows = MovieShow::findOrFail($movie_shows_id);

            $seats = Seat::all();

            foreach ($seats as $seat) {
                $isBooked = Booking::where('movie_shows_id', $movie_shows_id)
                    ->where('seat_id', $seat->id)
                    ->exists();

                $data[] = [
                    'id' => "$seat->id",
                    'seat_title' => $seat->seat_title,
                    'status' => $isBooked ? 'booked' : 'available',
                ];
            }

            $seats = json_decode(json_encode($data));

            return $this->sendResponse($seats, 'Seat availability fetched successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
