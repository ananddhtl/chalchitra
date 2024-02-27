<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends BaseApiController
{
    public function getHomepage()
    {
        $movies = Movie::all();

        if (!$movies) {
            return $this->sendError('Movies not found!');
        }

        return $this->sendResponse(MovieResource::collection($movies), 'List of the Movies fetched successfully!');
    }

    public function getmoviedescription($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->sendError('Movie not found!');
        }

        return $this->sendResponse(new MovieResource($movie), 'Movie fetched successfully!');
    }
}
