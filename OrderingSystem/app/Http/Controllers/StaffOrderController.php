<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\MenuItem;

class StaffOrderController extends Controller
{
    /**
     * Show all orders
     */
    public function index()
{
    $orders = OrderItem::with('order')
        ->selectRaw('order_id, SUM(subtotal) as total, MAX(created_at) as created_at, MAX(status) as status')
        ->groupBy('order_id')
        ->get();

    return view('staffs.orders', compact('orders'));
}


    /**
     * Show the edit status form for a specific order item
     */
    public function editStatus($id)
{
    // Fetch the order by its ID
    $order = Order::findOrFail($id);

    // Fetch all items belonging to this order
    $orderItems = OrderItem::where('order_id', $order->id)->get();

    // Calculate total properly
    $total = $orderItems->sum('subtotal');

    // Generate formatted order ID
    $order->formatted_order_id = 'ORD' . str_pad($order->id, 2, '0', STR_PAD_LEFT);

    return view('staffs.edit-status', [
        'orderItem' => $order,
        'orderItems' => $orderItems,
        'total' => $total,
    ]);
}


    /**
     * Update the status of a specific order item
     */
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|max:50',
    ]);

    // Find the order
    $order = Order::findOrFail($id);

    // Update its status
    $order->status = $request->status;
    $order->save();

    // Optional: also update all related order_items
    OrderItem::where('order_id', $order->id)->update(['status' => $request->status]);

    return redirect()
        ->route('staff.orders')
        ->with('success', 'Order status updated successfully!');
}

    
    public function finish($id)
{
    $order = Order::findOrFail($id);

    // Optional: You can log, archive, or store history here before deletion
    $order->delete();

    return redirect()->route('staff.orders')
                     ->with('success', 'Order marked as finished and removed successfully.');
}

}
