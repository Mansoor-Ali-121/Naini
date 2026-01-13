<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class SubcatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.sub_cat.add', compact('categories'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Actual_Slug' => 'required|string|max:255|unique:sub_categories,actual_slug',
            'cat_id' => 'required|exists:categories,id',
            'status' => 'required|string|in:active,inactive',
        ]);
        SubCategories::create($validatedData);
        return redirect()->route('subcategory.show')->with('success','Subcategory added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
        $subcats = SubCategories::with('category')->get();
        return view('dashboard.sub_cat.show', compact('subcats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcat = SubCategories::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.sub_cat.edit', compact('subcat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'Actual_Slug' => 'required|string|max:255|unique:sub_categories,actual_slug,'.$id,
            'cat_id' => 'required|exists:categories,id',
            'status' => 'required|string|in:active,inactive',
        ]);

        $subcat = SubCategories::findOrFail($id);
        $subcat->update($validatedData);

        return redirect()->route('subcategory.show')->with('success','Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategories::destroy($id);
        return redirect()->route('subcategory.show')->with('success','Subcategory deleted successfully.');
    }
}
