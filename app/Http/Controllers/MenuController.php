<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategories::all();
        return view('dashboard.menu.add', compact('categories', 'subcategories'));
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
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|string|regex:/^\$?\d+(\.\d{1,2})?$/', // Validate price format
            'menu_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'actual_slug' => 'required|string|max:255|unique:menus,actual_slug',
        ]);
        // Dollar sign aur kisi bhi kism ka comma khatam karne ke liye
        $price = str_replace(['$', ','], '', $validatedData['price']);

        // Prepare data for saving
        $data = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price'          => (float) $price, // Isay saaf number bana dein
            'actual_slug'    => $validatedData['actual_slug'],    // Yeh line add karein
            'category_id'    => $validatedData['category_id'],    // Yeh line add karein
            'subcategory_id' => $validatedData['subcategory_id'], // Yeh line add karein
        ];

        // Handle the menu_picture file upload
        if ($request->hasFile('menu_picture')) {
            $file = $request->file('menu_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Menus/menu_picture'), $filename);
            $data['menu_picture'] = $filename;
        }

        // Create the menu item
        Menu::create($data);

        // Redirect back with success message
        return redirect()->route('menu.add')->with('success', 'Menu item created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {

        $menus = Menu::all();
        return view('dashboard.menu.show', compact('menus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        $categories = Category::all();
        $subcategories = SubCategories::all();
        return view('dashboard.menu.edit', compact('menu', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|string|regex:/^\$?\d+(\.\d{1,2})?$/', // Validate price format
            'menu_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validate image
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'actual_slug' => 'required|string|max:255|unique:menus,actual_slug,' . $id,
        ]);

        // Find the menu item
        $menu = Menu::findOrFail($id);

        // Dollar sign aur kisi bhi kism ka comma khatam karne ke liye
        $price = str_replace(['$', ','], '', $validatedData['price']);

        // Prepare data for updating
        $data = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price'          => (float) $price, // Isay saaf number bana dein
            'actual_slug'    => $validatedData['actual_slug'],    // Yeh line add karein
            'category_id'    => $validatedData['category_id'],    // Yeh line add karein
            'subcategory_id' => $validatedData['subcategory_id'], // Yeh line add karein
        ];

        // Handle image upload
        if ($request->hasFile('menu_picture')) {
            // Delete old image if it exists
            if ($menu->menu_picture && file_exists(public_path('Menus/menu_picture/' . $menu->menu_picture))) {
                unlink(public_path('Menus/menu_picture/' . $menu->menu_picture));
            }

            // Upload new image
            $file = $request->file('menu_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Menus/menu_picture'), $filename);
            $data['menu_picture'] = $filename;
        } else {
            // Keep the existing image if no new image is uploaded
            $data['menu_picture'] = $menu->menu_picture;
        }

        // Update the menu item
        $menu->update($data);

        // Redirect back with success message
        return redirect()->route('menu.show')->with('success', 'Menu item updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        // Redirect back with success message
        return redirect()->route('menu.show')->with('success', 'Menu item deleted successfully.');
    }
}
