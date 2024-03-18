<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Resources\MovieResource;
use App\Http\Resources\MovieResourceCollection;
use App\Http\Resources\UpcomingMovieCollection;
use App\Http\Resources\UpcomingMovieResource;
use App\Models\Movie;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MovieController extends BaseApiController
{

    public function getDate()
    {
        $today = Carbon::now();
        $fiveDaysLater = $today->copy()->addDays(5);
        $dates = [];

        for ($i = 0; $i < 5; $i++) {
            $date = [
                'date' => $today->copy()->addDays($i)->format('Y-m-d'),
                'short_date' => $today->copy()->addDays($i)->format('M d'),
            ];

            array_push($dates, $date);
        }

        return $this->sendResponse($dates, 'Date fetched successfully!');
    }

    public function getHomepage(Request $request)
    {
        try {
            $date = $request->date;

            if (!$date) {
                $date = Carbon::now()->format('Y-m-d');
            }

            $movies = Movie::availableOn($date)->get();

            if (!$movies) {
                return $this->sendError('Movies not found!');
            }

            return $this->sendResponse(new MovieResourceCollection($movies, $date), 'List of ' . $movies->count() . ' Movies fetched successfully!');
        } catch (\Exception $e) {
            return $this->sendError('Server error!', $e->getMessage(), 500);
        }
    }

    public function getmoviedescription(Request $request, $id)
    {
        try {
            $date = $request->get('date');

            if (!$date) {
                $date = Carbon::now()->format('Y-m-d');
            }

            $movie = Movie::find($id);

            if (!$movie) {
                return $this->sendError('Movie not found!');
            }

            return $this->sendResponse(new MovieResource($movie, $date), 'Movie fetched successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 'Something went wrong!');
        }
    }

    public function getUpcomingMovies()
    {
        try {
            $date = Carbon::now()->addDay(5)->format('Y-m-d');

            $movies = Movie::releaseAfter($date)->get();

            if (!$movies) {
                return $this->sendError('Upcoming movies not found!');
            }

            return $this->sendResponse(new UpcomingMovieCollection($movies, $date), 'List of ' . $movies->count() . ' upcoming movies fetched successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 'Something went wrong');
        }
    }

    public function getSpecificUpcomingMovie(Request $request, $id)
    {
        $release_date = $request->release_date;
        try {
            $movie = Movie::where('id', $id)->where('publish_date', $release_date)->first();

            if (!$movie) {
                return $this->sendError('Movie not found!');
            }

            return $this->sendResponse(new UpcomingMovieResource($movie), 'Movie fetched successfully!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 'Something went wrong');
        }
    }
}
