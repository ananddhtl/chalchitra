<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MovieCategory;
use App\Models\Show;
use Illuminate\Validation\ValidationException;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::get();
        return view('backend.movie.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addmovie()
    {
        $category = MovieCategory::get();
        return view('backend.movie.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'title' => ['required', 'string', 'max:100', 'min:2'],
                'iframelink' => ['required'],
                'description' => ['required', 'string'],
                'thumbnail' => ['required',],
                'time_duration' => ['required',],
                'category' => ['required',],
                'publish_date' => ['required',],
                'end_date' => 'required|after:publish_date',

            ]);
            $movie = new Movie();
            $movie->title = $request->title;
            $movie->iframe_link = $request->iframelink;
            $movie->description = $request->description;
            $movie->category = $request->category;
            $movie->time_duration = $request->time_duration;
            $movie->publish_date = $request->publish_date;
            $movie->end_date = $request->end_date;

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('uploads/movies/', $img_name);
                $save_url = '/uploads/movies/' . $img_name;
                $movie->thumbnail = $save_url;
            }

            $movie->save();
            return redirect()->route('admin.getmovies')->with('message', 'Your data has been saved successfully');
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function assignShowtime($id)
    {
        $movie = Movie::findOrFail($id);
        $start_date = $movie->publish_date;
        $end_date = $movie->end_date;

        $movie_show_dates = [];

        while ($start_date <= $end_date) {
            $movie_show_dates[] = $start_date;
            $start_date = Carbon::parse($start_date)->addDay()->format('Y-m-d');
        }

        foreach ($movie_show_dates as $date) {
            $showTimesByDate[$date] = $movie->shows()->wherePivot('movie_date', $date)->pluck('show_id')->toArray();
        }

        // Custom sorting function
        // $sortedShowTimes = $showTimes->sortBy(function ($time) {
        //     // Extract hour and AM/PM from the time
        //     preg_match('/(\d+):(\d+) (AM|PM)/', $time, $matches);
        //     $hour = intval($matches[1]);
        //     $ampm = $matches[3];

        //     // Convert PM hours to 24-hour format
        //     if ($ampm === 'PM') {
        //         $hour += 12;
        //     }

        //     return $hour;
        // });
        // $data['show_times'] = $sortedShowTimes->all();

        $data['show_times'] = Show::all();
        $data['movie'] = $movie;
        $data['movie_show_dates'] = $movie_show_dates;
        $data['showTimesByDate'] = $showTimesByDate;

        return view('backend.movie.assign-show-time', $data);
    }

    public function storeMovieShowtime(Request $request)
    {
        $movidId = $request->movie_id;
        $movie = Movie::findOrFail($movidId);

        $moviesDates = $request->date;

        foreach ($moviesDates as $key => $md) {
            // Get currently selected show times
            $selectedShowTimes = $request->show_time[$key] ?? [];

            foreach ($selectedShowTimes as $showId) {
                // Check if the show is already associated with the movie for the given date
                $existingShow = $movie->shows()->wherePivot('movie_date', $md)->where('shows.id', $showId)->exists();

                if (!$existingShow) {
                    // If the show is not already associated, attach it
                    $movie->shows()->attach($showId, ['movie_date' => $md]);
                }
            }
            // Get existing show times for the date
            $existingShowTimes = $movie->shows()->wherePivot('movie_date', $md)->pluck('shows.id')->toArray();

            // Detach unselected show times
            $unselectedShowTimes = array_diff($existingShowTimes, $selectedShowTimes);
            $movie->shows()->detach($unselectedShowTimes, ['movie_date' => $md]);
        }

        return redirect()->route('admin.getmovies')->with('success', 'Your data has been saved successfully');
    }
}
