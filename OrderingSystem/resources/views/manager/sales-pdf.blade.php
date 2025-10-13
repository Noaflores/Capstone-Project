<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sales Report - {{ $monthName }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 30px;
        }
        h1 {
            text-align: center;
            color: #2e7d32;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #a5d6a7;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <h1>Sales Report for {{ $monthName }}</h1>

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
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->item_id }}</td>
                    <td>{{ $sale->item_name }}</td>
                    <td>{{ $sale->amount_sold }}</td>
                    <td>₱{{ number_format($sale->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total Sales: ₱{{ number_format($totalSales, 2) }}</p>
    </div>
</body>
</html>
