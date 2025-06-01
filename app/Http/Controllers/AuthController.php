<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('dashboard.auth.register');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ValidateData = $request->validate([

            'name' =>
            'required|string',
            'email' =>
            'required|email|unique:users',
            'password' =>
            'required|string|min:8',
            'confirm_password' =>
            'required|string|same:password',
            'address' =>
            'required|string',
            'contact' =>
            'required|string',
            'picture' =>
            'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        // Handle file upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('Users/users_pictures'), $fileName);
            $ValidateData['picture'] = $fileName;
        }
        $user = User::create($ValidateData);
        return redirect()->route('login.add')->with('success', 'User created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::all();
        return view('dashboard.auth.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.auth.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Changed to nullable
            'contact' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Changed to nullable
            'address' => 'required|string',
            'usertype' =>
            'required|string',
        ]);

        $user = User::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($user->picture && file_exists(public_path('Users/users_pictures/' . $user->picture))) {
                unlink(public_path('Users/users_pictures/' . $user->picture));
            }

            // Upload new file
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Users/users_pictures'), $filename);
            $validateData['picture'] = $filename;
        } else {
            // Keep existing picture if no new one uploaded
            $validateData['picture'] = $user->picture;
        }

        // Update user
        $user->update($validateData); // Fixed: calling update on the instance, not the model

        return redirect()->route('register.show')->with('success', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $user = User::find($id);

                // Delete old image if it exists
        if ($user->chef_picture && file_exists(public_path('Users/users_pictures' . $user->picture))
        ) {
            unlink(public_path('Users/users_pictures' . $user->picture));
        }

        $user->delete();
        return redirect()->route('register.show')->with('success', 'User deleted successfully');

    }

    /**
     *Login form.
     */
    public function loginform()
    {
        return view('dashboard.auth.login');
    }
}
