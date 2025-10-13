<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Monthly Sales Report - {{ date('F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 30px; }
        h1 { text-align: center; font-size: 20px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .total { text-align: right; font-weight: bold; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Monthly Sales Report</h1>
    <p><strong>Month:</strong> {{ date('F', mktime(0, 0, 0, $selectedMonth, 1)) }}</p>

    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Amount Sold</th>
                <th>Subtotal (₱)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->item_id }}</td>
                    <td>{{ $sale->item_name }}</td>
                    <td>{{ $sale->amount_sold }}</td>
                    <td>₱{{ number_format($sale->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Sales: ₱{{ number_format($totalSales ?? 0, 2) }}</p>
</body>
</html>
