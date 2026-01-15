<!DOCTYPE html>
<html>
<head>
    <title>Cart Page</title>
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
        
        /* Cart Header Section */
        .cart-header-section {
            background-color: #C4FFB6;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header-section h1 {
            font-size: 2.5em;
            color: #333;
            margin: 0 auto;
            position: relative;
            left: -100px;
        }

        .cart-actions-left button {
            background-color: #5CB85C;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .cart-actions-left button:hover {
            background-color: #4CAF50;
        }

        .cart-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-actions-right .continue-button { /* Specific class for Continue button */
            background-color: #337A33;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .cart-actions-right .continue-button:hover {
            background-color: #2D6A2D;
        }

        .cart-actions-right select {
            padding: 10px 15px;
            border-radius: 25px;
            border: 1px solid #ccc;
            background-color: white;
            font-size: 1em;
        }

        /* Cart Table Styling */
        .cart-container {
            max-width: 900px;
            margin: 30px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #ADD8E6;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .cart-table th {
            background-color: #C4FFB6;
            font-weight: bold;
            color: #333;
            font-size: 1.1em;
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .cart-table .total-row td {
            background-color: #E0F5E0;
            font-weight: bold;
            font-size: 1.2em;
            color: #333;
            border-top: 1px solid #C4FFB6;
        }
        .cart-table .total-row td:first-child {
            padding-left: 15px;
        }
        .remove-button {
            background-color: #F44336;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.9em;
        }
        .remove-button:hover {
            background-color: #D32F2F;
        }

        /* Modal Specific Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #C4FFB6; /* Light green background for modal */
            margin: auto;
            padding: 40px;
            border-radius: 15px;
            width: 80%; /* Could be adjusted */
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
        }

        .modal-content p {
            font-size: 1.8em; /* Larger text as in image */
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .modal-buttons button {
            padding: 15px 40px;
            border-radius: 25px;
            border: none;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-buttons .confirm-cancel {
            background-color: #5CB85C; /* Green for "Cancel" (in checkout modal) / "No" (in cancel modal) */
            color: white;
        }
        .modal-buttons .confirm-cancel:hover {
            background-color: #4CAF50;
        }

        .modal-buttons .confirm-purchase {
            background-color: #5CB85C; /* Green for "Purchase" (in checkout modal) / "Yes" (in cancel modal) */
            color: white;
        }
        .modal-buttons .confirm-purchase:hover {
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

<div class="cart-header-section">
    <div class="cart-actions-left">
        <button type="button" onclick="showCancelModal()">Cancel Purchase</button>
    </div>
    <h1>Cart:</h1>
    <div class="cart-actions-right">
        <select name="payment_method" id="paymentMethodSelect">
            <option value="Cash">Cash</option>
            <option value="Credit Card">Credit Card</option>
            <option value="GCash">GCash</option>
        </select>
        <button type="button" class="continue-button" onclick="showPurchaseModal()">Continue Purchase</button>
    </div>
</div>

<div class="cart-container">
    <table class="cart-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Order Date</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItemsList as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>₱{{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['order_date'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove', ['itemId' => $item['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-button">X</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td>Total:</td>
                <td>{{ $totalItems }} Items</td>
                <td>₱{{ number_format($totalPrice, 2) }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

<div id="purchaseModal" class="modal">
    <div class="modal-content">
        <p>Are you sure to purchase this Item?</p>
        <div class="modal-buttons">
            <button class="confirm-cancel" onclick="closePurchaseModal()">Cancel</button>
            <form id="purchaseForm" action="{{ route('cart.checkout') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="payment_method" id="modalPaymentMethod">
                <button type="submit" class="confirm-purchase">Purchase</button>
            </form>
        </div>
    </div>
</div>

<div id="cancelModal" class="modal">
    <div class="modal-content">
        <p>Do you wish to cancel this purchase?</p>
        <div class="modal-buttons">
            <button class="confirm-cancel" onclick="closeCancelModal()">No</button>
            <form id="cancelForm" action="{{ route('cart.cancel') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="confirm-purchase">Yes</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Get the modals
    const purchaseModal = document.getElementById('purchaseModal');
    const cancelModal = document.getElementById('cancelModal');
    const paymentMethodSelect = document.getElementById('paymentMethodSelect');
    const modalPaymentMethodInput = document.getElementById('modalPaymentMethod');

    // Function to show the Purchase Modal
    function showPurchaseModal() {
        // Set the hidden input in the modal form to the selected payment method
        modalPaymentMethodInput.value = paymentMethodSelect.value;
        purchaseModal.style.display = 'flex'; // Use flex to center
    }

    // Function to close the Purchase Modal
    function closePurchaseModal() {
        purchaseModal.style.display = 'none';
    }

    // Function to show the Cancel Modal
    function showCancelModal() {
        cancelModal.style.display = 'flex'; // Use flex to center
    }

    // Function to close the Cancel Modal
    function closeCancelModal() {
        cancelModal.style.display = 'none';
    }

    // Close modals if user clicks outside of them (optional)
    window.onclick = function(event) {
        if (event.target == purchaseModal) {
            closePurchaseModal();
        }
        if (event.target == cancelModal) {
            closeCancelModal();
        }
    }
</script>

</body>
</html>