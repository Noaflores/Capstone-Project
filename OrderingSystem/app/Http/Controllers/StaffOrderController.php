<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem; // assuming you have this model

class StaffOrderController extends Controller
{
    public function index()
    {
        // Fetch all orders (adjust logic if you need staff-specific filtering)
        $orders = OrderItem::with('order')->get();

return view('staffs.orders', compact('orders'));
    }
}
