<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month');
        $sales = collect();
        $totalSales = 0;

        if ($selectedMonth) {
            $sales = DB::table('order_items')
                ->join('menu_items', 'order_items.item_id', '=', 'menu_items.item_id')
                ->selectRaw('
                    menu_items.item_id as item_id,
                    menu_items.name as item_name,
                    SUM(order_items.quantity) as amount_sold,
                    SUM(order_items.subtotal) as subtotal
                ')
                ->whereMonth('order_items.created_at', $selectedMonth)
                ->groupBy('menu_items.item_id', 'menu_items.name')
                ->get();

            $totalSales = $sales->sum('subtotal');
        }

        $months = [
            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];

        return view('manager.sales-reports', compact('sales', 'totalSales', 'months', 'selectedMonth'));
    }

    public function downloadPDF(Request $request)
{
    $selectedMonth = $request->input('month', date('m')); // Default to current month
    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
    ];

    // ✅ Fetch the sales data
    $sales = DB::table('order_items')
        ->join('menu_items', 'order_items.item_id', '=', 'menu_items.item_id')
        ->select(
            'order_items.item_id',
            'menu_items.name as item_name',
            DB::raw('SUM(order_items.quantity) as amount_sold'),
            DB::raw('SUM(order_items.subtotal) as subtotal')
        )
        ->whereMonth('order_items.created_at', $selectedMonth)
        ->groupBy('order_items.item_id', 'menu_items.name')
        ->get();

    $totalSales = $sales->sum('subtotal');
    $monthName = $months[$selectedMonth] ?? 'Unknown';

    // ✅ Pass selectedMonth to the PDF view
    $pdf = Pdf::loadView('manager.sales-pdf', compact('sales', 'totalSales', 'monthName'))
          ->setPaper('a4', 'portrait')
          ->setOption('isHtml5ParserEnabled', true)
          ->setOption('isRemoteEnabled', true);

    return $pdf->download("Sales_Report_{$monthName}.pdf");
}

}
