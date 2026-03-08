<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Workers;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.workers.add');
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
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'actual_slug' => 'required|string|max:255|unique:workers,actual_slug',
            'field' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'role' => 'required|string|max:100',
            'status' => 'required|string|max:50',
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Workers/workers_pictures'), $fileName);
            $validatedData['picture'] = $fileName;
        }

        // Create a new worker record
        Workers::create($validatedData);
        return redirect()->route('workers.add')->with('success', 'Worker added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $workers = Workers::all();
        return view('dashboard.workers.show', compact('workers'));
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
