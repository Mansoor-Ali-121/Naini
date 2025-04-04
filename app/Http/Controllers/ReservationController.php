<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.reservation');
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
        $ValidatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'persons' => 'required|integer|min:1',
        ]);
        // Prepare data for saving
        Reservation::create($ValidatedData);
        // Redirect back with success message
        return redirect()->route('reservation.add')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $reservations = Reservation::all();
        return view('dashboard.reservations.show', compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservations = Reservation::findOrFail($id);
        return view('dashboard.reservations.edit', compact('reservations'));
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
