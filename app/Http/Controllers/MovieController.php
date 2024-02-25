<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MovieCategory;
use Illuminate\Validation\ValidationException;

class MovieController extends BaseApiController
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
                dd($e->getMessage());
                dd('cat3');
                $errors = $e->validator->errors();
                return redirect()->back()->withErrors($errors)->withInput();
            } catch (\Exception $ex) {
                dd('cat2', $ex->getMessage());
                return $ex->getMessage();
            }
        }
    }

    public function getHomepage()
    {
        $list = Movie::select('id', 'title', 'thumbnail', 'iframe_link', 'time_duration')->get();

        $data = [];
        foreach ($list as $movie) {
            $data[] = [
                'id' => $movie->id,
                'title' => $movie->title,
                'thumbnail' => $movie->thumbnail,
                'iframe_link' => $movie->iframe_link,
                'time_duration' => $movie->time_duration
            ];
        }

        return $this->sendResponse($data);
    }


    public function getmoviedescription(Request $request, $id)
    {
        $list = Movie::where('id', $id)->first();

        return $this->sendResponse($list);
    }
}
