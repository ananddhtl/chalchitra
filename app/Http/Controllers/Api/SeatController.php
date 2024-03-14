<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookingRequest;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\MovieShow;
use App\Models\Seat;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $payload = [
                'ticket_price' => config('constant.ticket_price'),
                'seat_details' => $seats,
            ];

            return $this->sendResponse($payload, 'Seat availability fetched successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function seatBooking(BookingRequest $request)
    {
        try {
            $seat_ids = $request->seat_ids;

            $bookedSeats = [];

            foreach ($seat_ids as $seat_id) {
                $check_seat_availability = Booking::where('movie_shows_id', $request->movie_shows_id)
                    ->where('seat_id', $seat_id)
                    ->where('payment_status', 'paid')
                    ->exists();

                if ($check_seat_availability) {
                    $bookedSeats[] = $seat_id;
                }
            }

            if (!empty($bookedSeats)) {
                return $this->sendError('Seats ' . implode(', ', $bookedSeats) . ' are already booked.', 'Seats already booked');
            }

            $slots = [];

            foreach ($seat_ids as $seat_id) {
                $attributes = [
                    'movie_shows_id' => $request->movie_shows_id,
                    'user_id' => Auth::user()->id,
                    'seat_id' => $seat_id,
                    'payment_status' => 'paid',
                    'reference_id' => $request->reference_id,
                    'booking_date' => Carbon::now()->format('Y-m-d'),
                ];

                $booking = Booking::create($attributes);

                $movieShowsId = MovieShow::where('id', $request->movie_shows_id)->first();
                $movie = Movie::where('id', $movieShowsId->movie_id)->first();

                $slots[] = [
                    'id' => $booking->id,
                    'seat_title' => $booking->seat->seat_title,
                ];
                
                $bookings = [
                    'users_name' => $booking->user->name,
                    'movie_name' => $movie->title,
                    'payment_status' => $booking->payment_status,
                    'booking_date' => $booking->booking_date,
                    'reference_id' => $booking->reference_id,
                    'bookings' => $slots
                ];
            }

            return $this->sendResponse($bookings, 'Seats booked successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 'Something went wrong');
        }
    }
}
