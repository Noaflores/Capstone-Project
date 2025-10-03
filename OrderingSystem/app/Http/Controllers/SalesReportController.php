<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // months for the dropdown
        $months = [
            '01'=>'January',
            '02'=>'February',
            '03'=>'March',
            '04'=>'April',
            '05'=>'May',
            '06'=>'June',
            '07'=>'July',
            '08'=>'August',
            '09'=>'September',
            '10'=>'October',
            '11'=>'November',
            '12'=>'December'
        ];

$selectedMonth = $request->has('month') ? $request->input('month') : '';

        // Example query — adapt table/column names to your schema
        $query = DB::table('order_items')
    ->join('menu_items', 'order_items.item_id', '=', 'menu_items.item_id')
    ->selectRaw('
        menu_items.item_id as item_id,
        menu_items.name as item_name,
        SUM(order_items.quantity) as amount_sold,
        SUM(order_items.subtotal) as subtotal
    ')
    ->groupBy('menu_items.item_id', 'menu_items.name');


        if (!empty($selectedMonth)) {
            // assumes order_items.created_at exists
            $query->whereMonth('order_items.created_at', $selectedMonth);
        }

        $sales = $query->get();
        $totalSales = $sales->sum('subtotal');

        return view('manager.sales-reports', compact('months', 'selectedMonth', 'sales', 'totalSales'));
    }
}
