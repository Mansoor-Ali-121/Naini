<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.contacts');
        
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
        // Validate the request data
        $ValidateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
        ]);

        // Create a new contact record
        Contacts::create($ValidateData);
    
        // Redirect to the contact page with success message
        return redirect()->route('contacts.add')->with('success', 'Thank you for your message. We will contact you soon.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    
        $contacts = Contacts::all();
        return view('dashboard.contacts.show', compact('contacts'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $contact = Contacts::find($id);
        return view('dashboard.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $ValidateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:500',
        ]);
        $contacts = Contacts::findOrFail($id);
        $contacts->update($ValidateData);

        // Redirect to the contact page with success message
        return redirect()->route('contacts.show')->with('success', 'Contact message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the contact message
        $contacts = Contacts::find($id);
        $contacts->delete();

        // Redirect to the contact page with success message
        return redirect()->route('contacts.show')->with('success', 'Contact message deleted successfully.');
    }
}
