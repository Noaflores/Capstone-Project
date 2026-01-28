<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user(); // Logged-in customer
        $cart = session()->get('cart', []); // Assuming you store cart in session
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'Pending'
        ]);

         //Optionally, save order items in another table (order_items)
         foreach ($cart as $item) {
             $order->items()->create([
                 'order_item_id' => $item['id'],
                 'quantity' => $item['quantity'],
                 'price' => $item['price']
             ]);
         }

        // Clear cart after creating order
        session()->forget('cart');

        // Redirect to a confirmation page with the real order_id
        return redirect()->route('order.confirmation', ['order_id' => $order->order_id]);
    }

    public function confirmation($order_id)
    {
        $order = Order::findOrFail($order_id);
        return view('confirmation', [
            'order' => $order,
            'paymentDetails' => [
                'method' => session('payment_method', 'GCash'), // Example
                'gcash_number' => session('gcash_number', null),
                'gcash_name' => session('gcash_name', null),
                'total' => $order->total,
            ]
        ]);
    }
}
