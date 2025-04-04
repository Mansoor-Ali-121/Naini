<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.events.add');
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
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|regex:/^\$?\d+(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Process price - remove dollar sign and convert to float
        $validatedData['price'] = (float) str_replace('$', '', $validatedData['price']);
    
        // Handle image upload (matches your blade file structure)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            
            // Store image in public directory as per your blade file's path
            $image->move(public_path('Events/events_pictures'), $imageName);
            $validatedData['image'] = $imageName;
        }
    
        // Create new event
        Events::create($validatedData);
    
        return redirect()->route('events.add')->with('success', 'Event created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $events = Events::all();
        return view('dashboard.events.show', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Events::findOrFail($id);
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|regex:/^\$?\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Process price - remove dollar sign and convert to float
        $validatedData['price'] = (float) str_replace('$', '', $validatedData['price']);

        // Handle image upload (matches your blade file structure)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            
            // Store image in public directory as per your blade file's path
            $image->move(public_path('Events/events_pictures'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Update event
        $event = Events::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.show')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Events::findOrFail($id);
        $event->delete();

        return redirect()->route('events.show')->with('success', 'Event deleted successfully!');
    }
}
