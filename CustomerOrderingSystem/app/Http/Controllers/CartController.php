<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cartItemsList = session('cart', []);
        $totalPrice = collect($cartItemsList)->sum('subtotal');
        $totalItems = collect($cartItemsList)->sum('quantity');

        return view('cart.payment.index', compact('cartItemsList', 'totalPrice', 'totalItems'));
    }

    // Add item to cart
    public function add(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'name'    => 'required|string',
            'price'   => 'required|numeric',
            'quantity'=> 'required|integer|min:1',
            'size'    => 'nullable|string',
        ]);

        $cart = session('cart', []);
        $size = $validated['size'] ?? 'N/A';
        $key = $validated['item_id'] . '_' . $size; // unique cart key for same item+size

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $validated['quantity'];
            $cart[$key]['subtotal'] = $cart[$key]['quantity'] * $cart[$key]['price'];
        } else {
            $cart[$key] = [
                'item_id'  => $validated['item_id'], // <-- use item_id
                'name'     => $validated['name'],
                'price'    => $validated['price'],
                'quantity' => $validated['quantity'],
                'size'     => $size,
                'subtotal' => $validated['price'] * $validated['quantity'],
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('status', $validated['name'].' added to cart.');
    }

    // Remove item from cart
    public function remove(Request $request)
    {
        $key = $request->input('cart_key');
        $cart = session('cart', []);

        if(isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]);
            return redirect()->route('cart.index')->with('status', 'Item removed from cart.');
        }

        return redirect()->route('cart.index')->with('status', 'Item not found in cart.');
    }

    // Cancel cart / order
    public function cancelOrder(Request $request)
    {
        session()->forget('cart'); // clear cart
        return redirect()->route('cart.index')->with('status', 'Your purchase has been cancelled.');
    }
}
