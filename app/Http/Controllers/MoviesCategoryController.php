<?php

namespace App\Http\Controllers;

use App\Models\MoviesCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MoviesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = MoviesCategory::all();
            return view("backend.category.list", compact("categories"));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            try {
                
                $request->validate([
                    'title' => ['required', 'string', 'max:100', 'min:2'],
                    
    
                ]);
    
                
                $moviesCategory = new MoviesCategory();
                $moviesCategory->title = $request->title;
                $moviesCategory->save();
                return redirect()->back()->with('message', 'Your data has been saved successfully');
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
    public function show(MoviesCategory $moviesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MoviesCategory $moviesCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MoviesCategory $moviesCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MoviesCategory $moviesCategory)
    {
        //
    }

    public function addcategory(Request $request)
    {
        return view('backend.category.add');
    }
}
