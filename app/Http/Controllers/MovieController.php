<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MovieCategory;
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
    { {
            try {

                $request->validate([
                    'title' => ['required', 'string', 'max:100', 'min:2'],
                    'iframelink' => ['required'],
                    'description' => ['required', 'string'],
                    'thumbnail' => ['required',],
                    'time_duration' => ['required',],
                    'category' => ['required',],
                    'publish_date' => ['required',],

                ]);
                $movie = new Movie();
                $movie->title = $request->title;
                $movie->iframe_link = $request->iframelink;
                $movie->description = $request->description;
                $movie->category = $request->category;
                $movie->time_duration = $request->time_duration;
                $movie->publish_date = $request->publish_date;
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }

    public function getHomepage()
    {
        $list = Movie::select('id', 'title', 'thumbnail')->get();

        $data = [];
        foreach ($list as $movie) {
            $data[$movie->id] = [
                'title' => $movie->title,
                'thumbnail' => $movie->thumbnail
            ];
        }

        return response()->json($data);
    }


    public function getmoviedescription(Request $request, $id)
    {
        $list = Movie::where('id', $id)->get();
        return response()->json($list);
    }

}