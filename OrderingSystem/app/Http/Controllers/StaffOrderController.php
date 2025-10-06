<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class StaffOrderController extends Controller
{
    /**
     * Show all orders
     */
    public function index()
    {
        // Load related order info
        $orders = OrderItem::with('order')->get();
        return view('staffs.orders', compact('orders'));
    }

    /**
     * Show the edit status form for a specific order item
     */
    public function editStatus($id)
    {
        // Fetch order item by its own ID
        $orderItem = OrderItem::findOrFail($id);

        return view('staffs.edit-status', compact('orderItem'));
    }

    /**
     * Update the status of a specific order item
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        // Update the specific order item
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->status = $request->status;
        $orderItem->save();

        return redirect()
            ->route('staff.orders')
            ->with('success', 'Order status updated successfully!');
    }
}
