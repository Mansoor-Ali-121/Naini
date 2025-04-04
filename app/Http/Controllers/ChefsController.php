<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use Illuminate\Http\Request;

class ChefsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.chefs.add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'experience' => 'required|integer|min:0',
        'chef_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        'specialty' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'phone' => 'required|string|max:20',
    ]);


    // Handle file upload (if a file is uploaded)
    if ($request->hasFile('chef_picture')) {
        $file = $request->file('chef_picture');
        $fileName = time() . '.' . $file->getClientOriginalName(); // Unique file name
        $file->move(public_path('Chefs/chefs_pictures'),$fileName); // Store in public disk
        $validatedData['chef_picture'] = $fileName; // Save file path to database
    }

    // Create a new Chef record in the database
    $chef = Chefs::create($validatedData);

    // Redirect to a success page or return a response
    return redirect()->route('chef.add')->with('success', 'Chef added successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Fetch the chef record from the database based on the provided ID
        $chefs = Chefs::all();

        return view('dashboard.chefs.show',compact('chefs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
