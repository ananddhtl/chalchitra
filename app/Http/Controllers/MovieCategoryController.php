<?php

namespace App\Http\Controllers;

use App\Models\MovieCategory;
use Illuminate\Http\Request;

class MovieCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = MovieCategory::get();
        return view('backend.moviecategory.list',compact('list'));

    }

    public function addcategory()
    {
        return view('backend.moviecategory.add');
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
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $category = new MovieCategory();
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieCategory $movieCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieCategory $movieCategory, $id)
    {
        
        $editcategory = MovieCategory::find($id);
        return view('backend.moviecategory.edit',compact('editcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovieCategory $movieCategory, $id)
    {
        {
         
            $request->validate([
                'title' => 'required|string|max:255',
            ]);
            $category = MovieCategory::findOrFail($id);
            $category->title = $request->input('title');
            $category->save();
            return redirect()->route('admin.listcategory')->with('success', 'Category updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieCategory $movieCategory)
    {
        //
    }
}