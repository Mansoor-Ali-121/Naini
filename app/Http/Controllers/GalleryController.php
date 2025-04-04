<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.gallery.add');
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
        // Validate the request
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store image in the public directory
            $image->move(public_path('Gallery/gallery_pictures'), $imageName);
    
            // Add the image name to the validated data
            $validatedData['image'] = $imageName; // Ensure this matches your database column name
        }
    
        // Create the gallery entry
        Gallery::create($validatedData);
    
        // Redirect with a success message
        return redirect()->route('gallery.add')->with('success', 'Gallery image uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $galleries = Gallery::all();
        return view('dashboard.gallery.show', compact('galleries'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        return view('dashboard.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $gallery = Gallery::findOrFail($id);
         
         $validated = $request->validate([
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
     
         if ($request->hasFile('image')) {
             // Delete old image
             if (file_exists(public_path('Gallery/gallery_pictures/'.$gallery->image))) {
                 unlink(public_path('Gallery/gallery_pictures/'.$gallery->image));
             }
             
             // Upload new image
             $image = $request->file('image');
             $imageName = time().'.'.$image->getClientOriginalExtension();
             $image->move(public_path('Gallery/gallery_pictures'), $imageName);
             $validated['image'] = $imageName;
         } else {
             $validated['image'] = $request->current_image;
         }
     
         $gallery->update($validated);
         return redirect()->route('gallery.show')->with('success', 'Image updated successfully!');
     }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);
        if (file_exists(public_path('Gallery/gallery_pictures/'.$gallery->image))) {
            unlink(public_path('Gallery/gallery_pictures/'.$gallery->image));
        }
        $gallery->delete();
        return redirect()->route('gallery.show')->with('success', 'Image deleted successfully!');
    }
}
