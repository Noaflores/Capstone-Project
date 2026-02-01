<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesReportController extends Controller
{
    /**
     * Display the sales report page with optional filters
     */
    public function index(Request $request)
    {
        $selectedMonth = $request->month;
        $searchSales = $request->search_sales;
        $searchCustomers = $request->search_customers;

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March',
            4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September',
            10 => 'October', 11 => 'November', 12 => 'December'
        ];

        // SALES QUERY with pagination (10 per page)
$sales = DB::table('sales')
    ->select(
        'item_id',
        'item_name',
        'size',            // <-- include size
        'user_id',
        'price',
        'created_at',
        DB::raw('quantity as amount_sold'),
        'subtotal'
    )
    ->when($selectedMonth, fn($q) => $q->whereMonth('created_at', $selectedMonth))
    ->when($searchSales, function ($query) use ($searchSales) {
        $query->where(function ($q) use ($searchSales) {
            $q->where('item_name', 'like', "%{$searchSales}%")
              ->orWhere('user_id', 'like', "%{$searchSales}%")
              ->orWhere('item_id', 'like', "%{$searchSales}%");
        });
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->withQueryString(); // preserve filters/search across pages

// Calculate total sales for the current filtered result
$totalSales = $sales->sum('subtotal');


        // CUSTOMERS QUERY (no pagination)
       $customers = DB::table('tbl_customer')
    ->select(
        'customer_id',
        DB::raw('Email as email'),
        'contact_number'
    )
    ->when($searchCustomers, function ($query) use ($searchCustomers) {
        $query->where(function ($q) use ($searchCustomers) {
            $q->where('Email', 'like', "%{$searchCustomers}%")
              ->orWhere('contact_number', 'like', "%{$searchCustomers}%");
        });
    })
    ->get();


        return view('manager.sales-reports', compact(
            'sales',
            'totalSales',
            'months',
            'selectedMonth',
            'customers',
            'searchSales',
            'searchCustomers'
        ));
    }

    /**
     * Download PDF of sales report using Nauman Neue font
     */
    public function downloadPDF(Request $request)
    {
        $selectedMonth = $request->input('month');
        $searchTerm = $request->input('search_sales');

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March',
            4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September',
            10 => 'October', 11 => 'November', 12 => 'December'
        ];

        // Get all sales (no pagination for PDF)
$sales = DB::table('sales')
    ->select(
        'item_id',
        'item_name',
        'size',         // <-- include size here too
        'user_id',
        'price',
        'created_at',
        DB::raw('quantity as amount_sold'),
        'subtotal'
    )
    ->when($selectedMonth, fn($q) => $q->whereMonth('created_at', $selectedMonth))
    ->when($searchTerm, function ($query) use ($searchTerm) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('item_name', 'like', "%{$searchTerm}%")
              ->orWhere('user_id', 'like', "%{$searchTerm}%")
              ->orWhere('item_id', 'like', "%{$searchTerm}%");
        });
    })
    ->orderBy('created_at', 'desc')
    ->get();


        $totalSales = $sales->sum('subtotal');
        $monthName = $months[$selectedMonth] ?? 'Unknown';

        $pdf = Pdf::loadView('manager.sales-pdf', compact('sales', 'totalSales', 'monthName'))
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $pdf->getDomPDF()->getOptions()->set('defaultFont', 'nauman');

        return $pdf->download("Sales_Report_{$monthName}.pdf");
    }
}
