<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // 1. Cart Page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('website.cart', compact('cart'));
    }

    // 2. Add To Cart
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

    // 3. Update Cart
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    // 4. Remove Item
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed!');
    }

    // 5. Stripe Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        // Dropdown se currency pakrein (default USD)
        $currency = strtolower($request->input('currency', 'usd'));
        $exchangeRate = 280;

        $totalAmount = 0;
        foreach ($cart as $details) {
            $totalAmount += $details['price'] * $details['quantity'];
        }

        // Amount calculation for Stripe
        $stripeAmount = ($currency == 'pkr') ? ($totalAmount * $exchangeRate) : $totalAmount;

        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $session = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => ['name' => 'Food Order - Naini Restaurant'],
                        'unit_amount' => (int)round($stripeAmount * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // Currency ko success URL mein pass karna zaroori hai
                'success_url' => route('payment.success') . '?currency=' . $currency,
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // 6. Payment Success Logic
    public function success(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->route('user.profile');

        // 1. URL query se currency aur exchange rate set karein
        $currency = strtolower($request->query('currency', 'usd'));
        $exchangeRate = 280;

        $totalUSD = 0;
        foreach ($cart as $details) {
            $totalUSD += $details['price'] * $details['quantity'];
        }

        // 2. Total Amount calculation
        $finalAmount = ($currency == 'pkr') ? ($totalUSD * $exchangeRate) : $totalUSD;

        // 3. Order Save
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_amount = $finalAmount;
        $order->currency = strtoupper($currency); // DB mein 'PKR' ya 'USD' save hoga
        $order->payment_status = 'Paid';
        $order->save();

        // 4. Order Items Save (Price conversion ke sath)
        foreach ($cart as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->menu_id = $id;
            $orderItem->quantity = $details['quantity'];

            // FIX: Agar currency PKR hai toh item ki price ko bhi convert karein warna DB mein hamesha USD price jayegi
            $orderItem->price = ($currency == 'pkr') ? ($details['price'] * $exchangeRate) : $details['price'];

            $orderItem->save();
        }

        // Success function ke andar email bhejne ka code (Order Receipt)
        try {
            // Order aur Cart dono bhej rahe hain
            \Illuminate\Support\Facades\Mail::to(Auth::user()->email)
                ->send(new \App\Mail\OrderReceipt($order, $cart));
        } catch (\Exception $e) {
            Log::error("Mail Error: " . $e->getMessage());
        }
        // ------------------------------------------------

        // 5. Cart saaf karein
        session()->forget('cart');

        // 6. Naye dynamic route par bhejien jo humne controller mein banaya hai
        return redirect()->route('order.confirmed', ['id' => $order->id]);
    }

    public function showSuccess($id)
    {
        // Order aur uske items/menu details fetch karein
        $order = Order::with('items.menu')->findOrFail($id);

        return view('website.success_page', compact('order'));
    }
}
