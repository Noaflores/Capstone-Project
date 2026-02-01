<x-app-layout>
    <x-slot name="title">GCash Checkout</x-slot>

    <style>
        body { font-family: Arial, sans-serif; margin:0; background-color:#F0F0F0; }

        /* Top bar */
        .top-bar {
            background-color: #C4FFB6;
            width: 100%;
            padding: 12px 30px;
            box-sizing: border-box;
        }
        .top-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 1.2em;
        }
        .logo img { width:40px; }

        /* Container */
        .cart-container {
            max-width: 900px;
            margin: 30px auto;
            background:white;
            border-radius:10px;
            padding:20px;
            box-shadow:0 4px 8px rgba(0,0,0,0.1);
            text-align: left; /* <-- left align details */
        }

        .order-info p { margin:10px 0; line-height:1.6; }
        .qr-code { 
            display:block; 
            margin: 10px auto; 
            border:1px solid #ccc; 
            border-radius:10px; 
            width:200px; 
            height:200px; 
            object-fit:contain; 
        }

        .button-row {
            display:flex;
            justify-content:center;
            gap:20px;
            margin-top:15px;
        }

        .btn {
            background-color:#5CB85C;
            color:white;
            padding:10px 25px;
            border-radius:25px;
            font-weight:bold;
            border:none;
            cursor:pointer;
            transition: background 0.3s;
        }
        .btn:hover { background-color:#4CAF50; }

        .btn-cancel {
            background-color:#F44336;
        }
        .btn-cancel:hover { background-color:#D32F2F; }
        /* Disabled button */
.btn:disabled {
    background-color: #A5D6A7;
    cursor: not-allowed;
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal {
    background: white;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    max-width: 350px;
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

.modal h3 {
    color: #2E7D32;
    margin-bottom: 10px;
}

#qrWrapper:hover img {
    transform: scale(1.03);
    transition: 0.2s ease;
}


    </style>

    <!-- Top bar -->
    <div class="top-bar">
        <div class="top-bar-inner">
            <div class="logo">
                <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo">
                Caffè Sant’Antonio
            </div>
        </div>
    </div>

    <!-- Main container -->
    <div class="cart-container">
        <h2 style="font-weight:bold; margin-bottom:15px;">GCash Checkout</h2>
        <p>Complete your payment to proceed with your order</p>

        <div class="order-info">
            <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>GCash Name:</strong> {{ $order->gcash_name }}</p>
            <p><strong>GCash Number:</strong> {{ $order->gcash_number }}</p>
            <p><strong>Total Amount:</strong> ₱{{ number_format($order->total, 2) }}</p>
            <p>Please complete your payment within 15 minutes, or your order will be cancelled.</p>
        </div>

        <p style="margin-bottom:10px; font-weight:bold; text-align:center;">Scan to Pay</p>

<div
    id="qrWrapper"
    style="text-align:center; cursor:pointer;"
>
    <img
        src="{{ asset('images/gcash-qr-sample.png') }}"
        alt="GCash QR Code"
        class="qr-code"
    />
</div>

<p style="font-size:0.9em; color:#666; text-align:center;">
    (Simulation only – no real payment)
</p>


<!-- Pay via GCash App -->
<p style="text-align:center; margin-top:10px;">
    <button
        type="button"
        id="gcashPayLink"
        class="btn"
        style="text-decoration:none;">
        Pay via GCash App
    </button>
</p>


<div class="button-row">
    <form action="{{ route('cart.index') }}" method="GET">
        <button type="submit" class="btn btn-cancel">Cancel Payment</button>
    </form>

    <form action="{{ route('payment.gcash.callback', $order->order_id) }}" method="POST">
        <input type="hidden" name="gcash_simulated" id="gcashSimulated" value="0">
        @csrf
        <button type="submit"
                class="btn"
                id="confirmPaymentBtn"
                disabled>
            Confirm Payment
        </button>
    </form>
</div>
    </div>

    <div class="modal-overlay" id="successModal">
    <div class="modal">
        <h3>Payment Successful</h3>
        <p>Your GCash payment was completed successfully.</p>
        <button class="btn" onclick="closeModal()">OK</button>
    </div>
</div>

<script>
    const confirmBtn = document.getElementById('confirmPaymentBtn');
    const qrWrapper = document.getElementById('qrWrapper');
    const payBtn = document.getElementById('gcashPayLink');
    const modal = document.getElementById('successModal');
    const simulatedInput = document.getElementById('gcashSimulated');

    function enablePayment() {
        if (!confirmBtn.disabled) return;

        confirmBtn.disabled = false;
        simulatedInput.value = '1';
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    // ✅ QR click (WORKING)
    qrWrapper.addEventListener('click', enablePayment);

    // ✅ GCash App click (WORKING)
    payBtn.addEventListener('click', function () {
        enablePayment();
        window.open('https://www.gcash.com', '_blank');
    });
</script>



</x-app-layout>

