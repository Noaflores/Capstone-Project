<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class StaffOrderController extends Controller
{
    /**
     * Display all orders for staff
     */
    public function index()
{
    $orders = Order::with(['orderItems', 'customer'])
        ->whereNotNull('user_id')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('staffs.orders', compact('orders'));
}


    /**
     * Show edit status form for a specific order
     */
    public function editStatus($id)
{
    $order = Order::with('orderItems')->findOrFail($id);

    // Calculate subtotal for each item dynamically
    $orderItems = $order->orderItems->map(function ($item) use ($order) {
    $item->subtotal = $item->price * $item->quantity;
    $item->payment_method = $order->payment_method;

        // Clean size: store null if empty or 'N/A'
        if (empty($item->size) || $item->size === 'N/A') {
            $item->size = null;
        }

        return $item;
    });

    $total = $orderItems->sum('subtotal');
    $order->formatted_order_id = 'ORD' . str_pad($order->order_id, 2, '0', STR_PAD_LEFT);

    return view('staffs.edit-status', [
        'orderItem'  => $order,
        'orderItems' => $orderItems,
        'total'      => $total,
    ]);
}


    /**
     * Update the status of a specific order
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('staff.orders')
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Finish an order: record it in sales and delete the order
     */
    public function finish($id)
{
    try {
        DB::transaction(function () use ($id) {

            $order = Order::with('orderItems')
                ->whereNotNull('user_id')
                ->findOrFail($id);

            if ($order->status !== 'Completed') {
                abort(403, 'Order must be completed before finishing.');
            }

            $customerId = $order->user_id;

            foreach ($order->orderItems as $item) {
                $itemSize = (!empty($item->size) && $item->size !== 'N/A')
                    ? $item->size
                    : null;

                Sale::create([
                    'order_item_id' => $item->order_item_id,
                    'user_id'       => $customerId,
                    'item_id'       => $item->item_id,
                    'item_name'     => $item->item_name,
                    'size'          => $itemSize,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                    'subtotal'      => $item->price * $item->quantity,
                ]);
            }

            $order->orderItems()->delete();
            $order->delete();
        });

        return redirect()->route('staff.orders')
            ->with('success', 'Order completed, recorded in sales, and removed successfully.');

    } catch (\Exception $e) {
        logger()->error('Failed to record sales for order_id ' . $id . ': ' . $e->getMessage());

        return redirect()->route('staff.orders')
            ->with('error', 'Failed to record sales. Check logs for details.');
    }
}

}
