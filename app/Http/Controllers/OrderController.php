<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
// use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Saare orders dikhane ke liye
    public function index()
    {
        $orders = Order::all(); // ya Order::with('user')->get();
        return view('dashboard.order.show_order', compact('orders'));
    }

    // Specific order ki details ke liye
    public function showDetails($id)
    {
        $order = Order::with('items.menu', 'user')->findOrFail($id);
        return view('dashboard.order.order_details', compact('order'));
    }
}
