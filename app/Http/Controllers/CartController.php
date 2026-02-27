<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu; // Menu model lazmi import karein

class CartController extends Controller
{
    // 1. Cart Page Dikhana
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('website.cart', compact('cart'));
    }

    // 2. Add To Cart (Jo aapke Plus + button se chalega)
    public function add($id)
    {
        $product = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->menu_picture
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added successfully!');
    }

    // 3. Update Cart (Quantity kam ya zyada karne ke liye)
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    // 4. Remove Item (Cart se nikalne ke liye)
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed!');
    }
}
