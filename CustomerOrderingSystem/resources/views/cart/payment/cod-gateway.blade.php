<x-app-layout>
    <x-slot name="title">Cash on Delivery</x-slot>

    <style>
        body { font-family: Arial, sans-serif; background-color: #F0F0F0; margin: 0; }

        /* Header */
        .top-bar {
            background-color: #C4FFB6;
            padding: 10px 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .top-bar-left {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 1.2em;
        }

        .btn {
            background-color: #5CB85C;
            color: white;
            padding: 8px 15px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            border: 2px solid #010201;
            cursor:pointer;
        }

        .btn:hover {
            background-color: #4CAF50;
        }

        .btn-cancel {
            background-color: #F44336;
        }

        .btn-cancel:hover {
            background-color: #D32F2F;
        }

        /* Cart container */
        .cart-container {
            max-width: 900px;
            margin: 20px auto 30px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .buttons-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 10px;
        }
    </style>

    <!-- HEADER -->
    <div class="top-bar">
        <div class="top-bar-left">
            <div class="logo">
                <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo" style="width:40px;">
                Caffè Sant’Antonio
            </div>
        </div>
    </div>

    <!-- COD CONTENT -->
    <div class="cart-container">
        <h2>Cash on Delivery</h2>
        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p><strong>Total:</strong> ₱{{ number_format($order->total, 2) }}</p>
        <p>Please prepare the exact amount to pay to our staff upon delivery.</p>

        <div class="buttons-wrapper">
            <!-- Confirm COD Payment -->
            <form action="{{ route('payment.cod.callback', $order->order_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn">Confirm COD Payment</button>
            </form>

            <!-- Cancel Purchase -->
            <form action="{{ route('cart.cancel') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-cancel">Cancel Purchase</button>
            </form>
        </div>
    </div>
</x-app-layout>
