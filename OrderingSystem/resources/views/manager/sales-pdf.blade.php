<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report - {{ $monthName }}</title>
    
    <style>
        body { font-family: 'nauman', sans-serif; font-size: 12px; color: #333; }
        h1 { text-align: center; margin-bottom: 20px; font-size: 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        tfoot td { font-weight: bold; }
        .right-align { text-align: right; }
    </style>
</head>
<body>
<h1>Sales Report - {{ $monthName }} {{ now()->year }}</h1>

    @if($sales->isEmpty())
        <p>No sales found for this month.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Sold By (User ID)</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Date Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->item_id }}</td>
                        <td>{{ $sale->item_name }}@if($sale->size) ({{ $sale->size }}) @endif</td>
                        <td>{{ $sale->user_id }}</td>
                        <td class="right-align">{{ number_format($sale->price, 2) }}</td>
                        <td class="right-align">{{ $sale->amount_sold }}</td>
                        <td class="right-align">{{ number_format($sale->subtotal, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="right-align">Total Sales:</td>
                    <td class="right-align">{{ number_format($totalSales, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    @endif
</body>
</html>
