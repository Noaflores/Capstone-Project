<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // =========================
    // ADD ITEM TO CART
    // =========================
    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'item_id'  => 'required|integer',
            'name'     => 'required|string',
            'price'    => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'size'     => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        $size = $validated['size'] ?? 'N/A';
        $uniqueKey = $validated['item_id'] . '_' . $size;
        $price = (float)$validated['price'];

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['quantity'] += $validated['quantity'];
        } else {
            $cart[$uniqueKey] = [
                'id'         => $validated['item_id'],
                'name'       => $validated['name'],
                'size'       => $size,
                'price'      => $price,
                'quantity'   => $validated['quantity'],
                'order_date' => now()->format('Y-m-d H:i:s'),
            ];
        }

        $cart[$uniqueKey]['subtotal'] = $cart[$uniqueKey]['price'] * $cart[$uniqueKey]['quantity'];

        session()->put('cart', $cart);

        $sizeText = ($size !== 'N/A') ? " ({$size})" : '';
        return redirect()->route('cart.index')
                         ->with('status', $validated['name'] . $sizeText . ' added to cart!');
    }

    // =========================
    // SHOW CART
    // =========================
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItemsList = [];

        foreach ($cart as $key => $item) {
            $cartItemsList[] = [
                'key'        => $key,
                'id'         => $item['id'],
                'name'       => $item['name'],
                'size'       => $item['size'] ?? null,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'subtotal'   => $item['subtotal'],
                'order_date' => $item['order_date'] ?? '-',
            ];
        }

        $totalItems = collect($cartItemsList)->sum('quantity');
        $totalPrice = collect($cartItemsList)->sum('subtotal');

        return view('cart.payment.index', compact('cartItemsList', 'totalItems', 'totalPrice'));
    }

    // =========================
    // REMOVE ITEM FROM CART
    // =========================
    public function removeItem(Request $request)
    {
        $cartKey = $request->input('cart_key');
        $cart = session()->get('cart', []);

        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('status', 'Item removed from cart.');
    }

    // =========================
    // CANCEL PURCHASE
    // =========================
    public function cancel()
    {
        session()->forget('cart');
        return redirect()->route('menu.index')->with('status', 'Purchase cancelled.');
    }

    // =========================
    // PROCESS ORDER (Show confirmation with prefilled GCash)
    // =========================
    public function processOrder(Request $request)
    {
        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty!');
        }

        // Get customer using email (most reliable)
        $customer = DB::table('tbl_customer')
              ->where('gcash_number', '09123456789')
              ->first();


        if (!$customer) {
            return redirect()->route('cart.index')
                             ->with('status', 'Invalid customer ID. Please check your account.');
        }

        $total = array_sum(array_map(fn($item) => $item['subtotal'], $cartItems));

        // Insert order now with status "Pending GCash Payment" to generate order_id
        DB::beginTransaction();
        try {
            $orderId = DB::table('orders')->insertGetId([
    'user_id'        => $customer->customer_id,
    'payment_method' => 'GCash',
    'total'          => $total,
    'status'         => 'Pending', // <-- changed from 'Pending GCash Payment'
    'gcash_name'     => $customer->gcash_name ?? '',
    'gcash_number'   => $customer->gcash_number ?? '',
    'created_at'     => now(),
    'updated_at'     => now(),
]);


            // Insert order items
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id'  => $orderId,
                    'item_id'   => $item['id'],
                    'item_name' => $item['name'],
                    'size'      => $item['size'],
                    'price'     => $item['price'],
                    'quantity'  => $item['quantity'],
                    'subtotal'  => $item['subtotal'],
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }

            DB::commit();

            // Save payment details in session for confirmation page
            session(['paymentDetails' => [
                'customer_id'  => $customer->customer_id,
                'order_id'     => $orderId,
                'cart_items'   => $cartItems,
                'total'        => $total,
                'method'       => 'GCash',
                'gcash_name'   => $customer->gcash_name ?? '',
                'gcash_number' => $customer->gcash_number ?? '',
            ]]);

            return view('cart.payment.confirmation', [
                'paymentDetails' => session('paymentDetails')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                             ->with('status', 'Failed to create order: ' . $e->getMessage());
        }
    }

    // =========================
    // COMPLETE ORDER (After Confirmation)
    // =========================
    public function completeOrder(Request $request)
    {
        $paymentDetails = session('paymentDetails');

        if (!$paymentDetails) {
            return redirect()->route('cart.index')->with('status', 'No pending order found.');
        }

        // No need for user input, validate against DB
        $customer = DB::table('tbl_customer')
                      ->where('customer_id', $paymentDetails['customer_id'])
                      ->first();

        if (!$customer) {
            return redirect()->route('cart.index')
                             ->with('status', 'Invalid customer ID. Please check your account.');
        }

        DB::beginTransaction();
        try {
            // Order is already inserted, just update status to completed
            DB::table('orders')
    ->where('order_id', $paymentDetails['order_id']) // <- use order_id
    ->update([
        'status'     => 'Pending', // or whatever status you want
        'updated_at' => now(),
    ]);



            DB::commit();

            // Clear cart & payment session
            session()->forget(['cart', 'paymentDetails']);

            // Save order ID for thank-you page
            session(['completedOrderId' => $paymentDetails['order_id']]);

            return redirect()->route('payment.completed')
                             ->with('status', 'Order successfully placed!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                             ->with('status', 'Order completion failed: ' . $e->getMessage());
        }
    }

    // =========================
    // SHOW COMPLETED PAGE
    // =========================
    public function showCompletedPage()
    {
        $orderId = session('completedOrderId');
        if (!$orderId) {
            return redirect()->route('cart.index')->with('status', 'No completed order found.');
        }

        return view('cart.payment.completed', ['orderId' => $orderId]);
    }
}
