<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's shopping cart.
     */

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string'
        ]);

        // Get the current cart from the session, or an empty array if it doesn't exist
        $cart = $request->session()->get('cart', []);
        
        $itemId = $validated['item_id'];
        $quantity = $validated['quantity'];
        
        // Prepare the new item data
        $newItem = [
            'id' => $itemId,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $quantity,
            'order_date' => now()->format('Y-m-d'), // Use current date
            'size' => $request->size
        ];
        
        // Check if the item already exists in the cart (to update quantity)
        if (isset($cart[$itemId])) {
    // Increments quantity if item already exists
    $cart[$itemId]['quantity'] += $quantity; 
    } else {
    // Adds as a new item
    $cart[$itemId] = $newItem;
}

        // Store the updated cart array back into the session
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Item added to cart!');
    }


    /**
     * Display the user's shopping cart. (UPDATED to use Session)
     */
    public function index(Request $request)
    {
        // Fetch cart items from the session
        $cartItems = $request->session()->get('cart', []);
        
        // Convert the associative array back to a simple list for the view if needed, 
        // or just pass the values
        $cartItemsList = array_values($cartItems); 

        $totalItems = count($cartItemsList);
        $totalPrice = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cartItemsList));

        return view('cart.payment.index', compact('cartItemsList', 'totalItems', 'totalPrice'));
    }
    /**
     * Handle updating cart items (e.g., changing quantity).
     */
    public function update(Request $request)
    {
        // Logic to update cart item quantity or remove items
        return redirect()->route('cart.index')->with('status', 'Cart updated.');
    }

    /**
     * Handle canceling the entire purchase.
     */
    public function cancel()
    {
        // Logic to clear the cart or mark an order as canceled
         return redirect('menu')->with('status', 'Purchase cancelled.');
    }

    
    public function removeItem(Request $request, $itemId)
    {
        // Get the current cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item exists in the cart by its ID (which is the array key)
        if (isset($cart[$itemId])) {
            // Remove the item from the array
            unset($cart[$itemId]);

            // Store the modified cart array back into the session
            $request->session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('status', 'Item successfully removed from cart.');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }

    public function checkout(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        
        // For demonstration, let's store payment details in session
        // In a real app, you might store this in a temporary order table
        $cartItems = $request->session()->get('cart', []);
        $totalPrice = array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], array_values($cartItems)));

        $request->session()->put('current_payment_details', [
            'method' => $paymentMethod,
            'total' => $totalPrice,
            // Example GCash details (these would usually come from config or a user profile)
            'gcash_number' => '09159999999', 
            'gcash_name' => 'Ca** S*****O', 
        ]);

        // Redirect to the new confirmation page
        return redirect()->route('cart.confirm');
    }

    /**
     * Display the order confirmation page.
     */
    public function showConfirmation(Request $request)
{
    $request->session()->put('confirmation', [
        'method' => 'GCash',
        'gcash_number' => '09171234567',
        'gcash_name' => 'John Doe',
        'total' => $request->base_price * $request->quantity,
    ]);

    return redirect()->route('cart.confirm');
}

public function confirmPage(Request $request)
{
    $paymentDetails = $request->session()->get('confirmation');

    if (!$paymentDetails) {
        return redirect()->route('menu.index');
    }

    return view('confirmation', compact('paymentDetails'));
}


    public function processOrder(Request $request)
    {
        // In a real application, this is where you would:
        // 1. Permanently save the order details to your 'orders' table.
        // 2. Decrement stock levels.
        // 3. Send order confirmation emails.
        // 4. Handle actual payment gateway interaction (if not already done).

        // Clear the cart and any temporary payment details from the session
        $request->session()->forget('cart'); 
        $request->session()->forget('current_payment_details'); 

        // Redirect to the new payment completed page
        return redirect()->route('payment.completed');
    }

    /**
     * Display the payment completed page.
     */
    public function showCompletedPage()
    {
        return view('cart.payment.completed'); // Assumes resources/views/cart/payment/completed.blade.php
    }
}
