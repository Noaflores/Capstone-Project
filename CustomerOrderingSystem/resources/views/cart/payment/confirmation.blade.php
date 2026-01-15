<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page (Customer)</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            background-color: #F0F0F0;
        }
        
        /* Top Header Bar */
        .top-bar {
            background-color: #C4FFB6;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .logo-container img {
            width: 40px;
            margin-right: 10px;
        }
        
        /* Return to Cart Button */
        .return-to-cart-button {
            background-color: #5CB85C; /* Darker, vibrant green */
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 20px 0 0 50px; /* Adjust margin to match image placement */
            display: inline-block; /* Allow margin to work */
        }
        
        .return-to-cart-button:hover {
            background-color: #4CAF50; 
        }

        /* GCash Logo */
        .gcash-logo {
            width: 80px; /* Adjust size as needed */
            height: auto;
            margin: 30px 0 20px 50px; /* Margin to match image placement */
        }

        /* Confirmation Box */
        .confirmation-box {
            max-width: 800px;
            margin: 20px auto; /* Center the box */
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Align content to the top */
            gap: 30px;
            border: 1px solid #ADD8E6; /* Light blue border */
        }

        .payment-details-left {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .payment-detail {
            font-size: 1.3em;
            color: #333;
            line-height: 1.5;
        }

        .payment-detail strong {
            font-weight: bold;
            color: #555;
        }

        .payment-detail span {
            font-weight: normal; /* For the actual number/name */
            color: #000;
        }

        .order-summary-right {
            text-align: right;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .order-summary-right .total {
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .order-summary-right .note {
            font-size: 0.9em;
            color: #555;
            max-width: 250px; /* Limit width for readability */
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .order-summary-right .proceed-button {
            background-color: #5CB85C; /* Green button */
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1.2em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .order-summary-right .proceed-button:hover {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Café Logo" class="logo">
        Caffè Sant’Antonio
    </div>
</div>

<a href="{{ route('cart.index') }}" class="return-to-cart-button">Return to Cart</a>

@if ($paymentDetails['method'] == 'GCash')
    <img src="{{ asset('images/gcash_logo.png') }}" alt="GCash Logo" class="gcash-logo">
@endif

<div class="confirmation-box">
    <div class="payment-details-left">
        @if ($paymentDetails['method'] == 'GCash')
            <div class="payment-detail">
                <strong>Gcash Number :</strong> <br>
                <span>{{ $paymentDetails['gcash_number'] ?? 'N/A' }}</span>
            </div>
            <div class="payment-detail">
                <strong>Gcash Name :</strong> <br>
                <span>{{ $paymentDetails['gcash_name'] ?? 'N/A' }}</span>
            </div>
        @else
            <div class="payment-detail">
                <strong>Payment Method:</strong> <span>{{ $paymentDetails['method'] }}</span>
            </div>
            <div class="payment-detail">
                <strong>Confirmation ID:</strong> <span>#{{ uniqid() }}</span> {{-- Placeholder --}}
            </div>
        @endif
    </div>
    <div class="order-summary-right">
        <div class="total">Total: ₱{{ number_format($paymentDetails['total'], 2) }}</div>
        <div class="note">Note: Please click Proceed after confirming the payment.</div>
        <form action="{{ route('order.proceed') }}" method="POST">
            @csrf
            <button type="submit" class="proceed-button">Proceed</button>
        </form>
    </div>
</div>

</body>
</html>