<?php

namespace App\Http\Controllers;

use App\Mail\ReservationStatusMail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'persons' => 'required|integer|min:1',
        ]);

        // YAHAN CHANGE HAI: Reservation create karke variable mein save karein
        $reservation = Reservation::create($validatedData);
        $mailMessage = "Humein aapki reservation mil gayi hai! Hum jald hi check karke aapko update denge.";

        Mail::to($reservation->email)->send(new ReservationStatusMail($reservation, $mailMessage));

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


    // UPdate status Mail 
    public function updateStatus(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:pending,confirmed,declined', // Dashboard ki values
        ]);

        // 1. Reservation find karein aur update karein
        $reservation = Reservation::findOrFail($id);
        $reservation->update($validatedData);

        // 2. Decision ke mutabiq email ka message tayyar karein
        if ($reservation->status == 'confirmed') {
            $mailMessage = "Congratulations! Your reservation has been confirmed. We'll be waiting for you.";
        } else {
            $mailMessage = "Sorry! We cannot accept your reservation at this time. Please contact us for more details.";
        }

        // 3. User ko email bhejein (Mail class aur Message pass karein)
        Mail::to($reservation->email)->send(new \App\Mail\ReservationStatusMail($reservation, $mailMessage));

        // 4. Redirect back
        return redirect()->route('reservation.show')->with('success', 'Status updated and email sent to ' . $reservation->email);
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

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'persons' => 'required|integer|min:1',
        ]);

        // Find the reservation and update it
        $reservation = Reservation::find($id);
        $reservation->update($validatedData);

        // Redirect back with success message
        return redirect()->route('reservation.show')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('reservation.show')->with('success', 'Reservation deleted successfully!');
    }
}
