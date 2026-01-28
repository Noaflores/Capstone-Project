<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }

        .top-bar { background-color: #C4FFB6; padding: 10px 20px; display: flex; align-items: center; }
        .logo-container { display: flex; align-items: center; font-size: 1.5em; font-weight: bold; color: #333; }
        .logo-container img { width: 40px; margin-right: 10px; }

        .return-to-cart-button {
            background-color: #5CB85C; color: white; text-decoration: none;
            padding: 10px 18px; border-radius: 25px; font-size: 1em;
            font-weight: bold; border: none; cursor: pointer; display: inline-block;
            margin: 20px 0 0 50px;
        }
        .return-to-cart-button:hover { background-color: #4CAF50; }

        .confirmation-box {
            max-width: 800px; margin: 20px auto; background-color: white;
            border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px; display: flex; justify-content: space-between;
            align-items: flex-start; gap: 30px; border: 1px solid #ADD8E6;
        }

        .payment-details-left { flex-grow: 1; display: flex; flex-direction: column; gap: 15px; }
        .payment-detail { font-size: 1.3em; color: #333; line-height: 1.5; }
        .payment-detail strong { font-weight: bold; color: #555; }
        .payment-detail span { font-weight: normal; color: #000; }

        .order-summary-right {
            text-align: center; flex-shrink: 0; display: flex; flex-direction: column;
            align-items: center; gap: 15px;
        }
        .order-summary-right .total { font-size: 2.5em; font-weight: bold; color: #333; margin-bottom: 10px; }
        .order-summary-right .note { font-size: 0.9em; color: #555; max-width: 250px; line-height: 1.4; margin-bottom: 20px; }
        .order-summary-right .proceed-button {
            background-color: #5CB85C; color: white; padding: 12px 30px;
            border-radius: 25px; font-size: 1.2em; font-weight: bold; border: none; cursor: pointer;
        }
        .order-summary-right .proceed-button:hover { background-color: #4CAF50; }

        .gcash-qr { max-width: 250px; margin-top: 15px; border: 1px solid #ccc; padding: 10px; border-radius: 10px; }
        input[readonly] { border: none; background-color: #f0f0f0; padding: 5px 10px; font-size: 1em; width: 100%; }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Café Logo">
        Caffè Sant’Antonio
    </div>
</div>

<a href="{{ route('cart.index') }}" class="return-to-cart-button">Return to Cart</a>

<div class="confirmation-box">
    <div class="payment-details-left">
        <div class="payment-detail">
            <strong>Order ID:</strong>
            <span>#{{ $paymentDetails['order_id'] ?? 'Pending' }}</span>
        </div>

        <div class="payment-detail">
            <strong>Payment Method:</strong> 
            <span>{{ $paymentDetails['method'] }}</span>
        </div>

        @if($paymentDetails['method'] === 'GCash')
            <div class="payment-detail">
                <strong>GCash Name:</strong>
                <input type="text" value="{{ $paymentDetails['gcash_name'] }}" readonly>
            </div>
            <div class="payment-detail">
                <strong>GCash Number:</strong>
                <input type="text" value="{{ $paymentDetails['gcash_number'] }}" readonly>
            </div>
        @endif
    </div>

    <div class="order-summary-right">
        <div class="total">Total: ₱{{ number_format((float)$paymentDetails['total'], 2) }}</div>

        @if($paymentDetails['method'] === 'GCash')
            <img src="{{ asset('images/gcash_qr.jpg') }}?v={{ time() }}" alt="GCash QR" class="gcash-qr">
            <div class="note">Scan this QR code using GCash to pay exactly ₱{{ number_format((float)$paymentDetails['total'], 2) }}.</div>
        @else
            <div class="note">Please click "Proceed" once the cash payment is done.</div>
        @endif

        <!-- Proceed button to mark order as completed -->
        <form action="{{ route('cart.complete') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $paymentDetails['order_id'] ?? '' }}">
            <button type="submit" class="proceed-button">Proceed</button>
        </form>
    </div>
</div>

</body>
</html>
