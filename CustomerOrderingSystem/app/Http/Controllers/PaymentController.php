<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    // =========================
    // CHECKOUT → CREATE ORDER
    // =========================
    public function checkout(Request $request)
{
    $request->validate([
        'payment_method' => 'required|in:GCash,COD',
    ]);

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
    }

    $customer = auth()->user();
    $total = collect($cart)->sum('subtotal');
    $paymentMethod = $request->payment_method;

    DB::beginTransaction();
    try {
        // Insert order
        DB::table('orders')->insert([
            'user_id'        => $customer->customer_id,
            'payment_method' => $paymentMethod,
            'gcash_name'     => $paymentMethod === 'GCash' ? $customer->gcash_name : null,
            'gcash_number'   => $paymentMethod === 'GCash' ? $customer->gcash_number : null,
            'total'          => $total,
            'status'         => $paymentMethod === 'GCash' ? 'PENDING_PAYMENT' : 'PENDING_COD',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Get last inserted ID (works with non-standard PK)
        $orderId = DB::getPdo()->lastInsertId();

        // Insert order items
        foreach ($cart as $item) {
    DB::table('order_items')->insert([
        'order_id'       => $orderId,
        'item_id'        => $item['item_id'],
        'item_name'      => $item['name'],
        'size'           => $item['size'] ?? 'N/A',
        'quantity'       => $item['quantity'],
        'price'          => $item['price'],
        'subtotal'       => $item['subtotal'],
        'payment_method' => $paymentMethod, // <- add this
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);
}
    

        DB::commit();
        session()->forget('cart');

        // Redirect based on payment method
        if ($paymentMethod === 'GCash') {
            return redirect()->route('payment.gcash', $orderId);
        } else {
            return redirect()->route('payment.cod', $orderId);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('status', $e->getMessage());
    }
}

    // =========================
    // SHOW GCASH PAGE
    // =========================
    public function showGCashGateway($orderId)
    {
        $order = DB::table('orders')
            ->where('order_id', $orderId)
            ->first();

        if (!$order || $order->status !== 'PENDING_PAYMENT') {
            return redirect()->route('cart.index')
                ->with('status', 'Invalid order.');
        }

        return view('cart.payment.gcash-gateway', compact('order'));
    }

    // =========================
    // I'VE PAID BUTTON
    // =========================
    public function gcashCallback(Request $request, $orderId)
{
    if ($request->gcash_simulated !== '1') {
        return redirect()
            ->route('cart.index')
            ->with('status', 'GCash payment not completed.');
    }

    $order = DB::table('orders')
        ->where('order_id', $orderId)
        ->first();

    if (!$order || $order->status !== 'PENDING_PAYMENT') {
        return redirect()->route('cart.index');
    }

    DB::beginTransaction();
    try {
        DB::table('orders')
            ->where('order_id', $orderId)
            ->update([
                'status'     => 'PAID',
                'updated_at' => now(),
            ]);

        DB::commit();

        return redirect()->route('payment.completed');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('status', $e->getMessage());
    }
}
// =========================
// SHOW CASH-ON-DELIVERY PAGE
// =========================
public function showCODGateway($orderId)
{
    $order = DB::table('orders')->where('order_id', $orderId)->first();

    if (!$order || $order->status !== 'PENDING_COD') {
        return redirect()->route('cart.index')->with('status', 'Invalid order.');
    }

    return view('cart.payment.cod-gateway', compact('order'));
}

// =========================
// COD CONFIRMATION CALLBACK
// =========================
public function codCallback(int $orderId)
{
    $order = DB::table('orders')->where('order_id', $orderId)->first();

    if (!$order || $order->status !== 'PENDING_COD') {
        return redirect()->route('cart.index');
    }

    DB::table('orders')->where('order_id', $orderId)->update([
        'status' => 'PAID',
        'updated_at' => now(),
    ]);

    return redirect()->route('payment.completed');
}


}
