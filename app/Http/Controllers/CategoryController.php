<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.add');
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

        $vadlidateData = $request->validate([

            'name' =>'required|min:3|max:255',
            'ActualSlug' =>'required|min:3|max:255|unique:categories,ActualSlug',
            'description' =>'required|min:3|max:255',
        ]);
        // Store the data in the database
        Category::create($vadlidateData);
        // Redirect to the dashboard
        return redirect()->route('category.show')->with('success', 'Category added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cats = Category::all();
        // dd($cats);
        return view('dashboard.categories.show', compact('cats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cat = Category::find($id);
        return view('dashboard.categories.edit',compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vadlidateData = $request->validate([

            'name' =>'required|min:3|max:255',
            'ActualSlug' => 'required|min:3|max:255|unique:categories,ActualSlug,'.$id,
            'description' =>'required|min:3|max:255',
        ]);
        // Update the data in the database
        $cat = Category::findOrFail($id);
        $cat->update($vadlidateData);
        // Redirect to the dashboard
        return redirect()->route('category.show')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Category::find($id);
        $cat->delete();
        // Redirect to the dashboard
        return redirect()->route('category.show')->with('success', 'Category deleted successfully');
    }
}
