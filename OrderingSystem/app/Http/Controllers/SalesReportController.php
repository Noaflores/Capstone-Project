<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index(Request $request)
{
    $selectedMonth = $request->input('month'); // Use 'month' to match the form
    $sales = collect(); // Default to an empty collection
    $totalSales = 0;

    // Only run the query if a month has been submitted
    if ($selectedMonth) {
        $query = DB::table('order_items')
            ->join('menu_items', 'order_items.item_id', '=', 'menu_items.item_id')
            ->selectRaw('
                menu_items.item_id as item_id,
                menu_items.name as item_name,
                SUM(order_items.quantity) as amount_sold,
                SUM(order_items.subtotal) as subtotal
            ')
            ->whereMonth('order_items.created_at', $selectedMonth)
            ->groupBy('menu_items.item_id', 'menu_items.name');

        $sales = $query->get();
        $totalSales = $sales->sum('subtotal');
    }

    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
    ];

    return view('manager.sales-reports', compact('sales', 'totalSales', 'months', 'selectedMonth'));
}
}
