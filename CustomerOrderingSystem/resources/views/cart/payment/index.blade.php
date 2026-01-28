<!DOCTYPE html>
<html>
<head>
    <title>Cart Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }

        /* Top Header Bar */
        .top-bar {
            background-color: #C4FFB6;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            font-weight: bold;
        }
        .top-bar img { width: 40px; margin-right: 10px; }

        /* Cart Header Section */
        .cart-header-section {
            background-color: #C4FFB6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .cart-header-section h1 { font-size: 2em; margin: 0; }

        .cart-actions-left { position: absolute; left: 20px; }
        .cart-actions-left button {
            padding: 12px 25px; border-radius: 25px; border: none;
            font-weight: bold; cursor: pointer; font-size: 1.1em;
            transition: background-color 0.3s; background-color: #F44336; color: white;
        }
        .cart-actions-left button:hover { background-color: #D32F2F; }

        .cart-actions-right { position: absolute; right: 20px; }
        .continue-button {
            background-color: #5CB85C; color: white; padding: 10px 20px;
            font-size: 1em; border-radius: 25px; cursor: pointer;
            transition: background-color 0.3s; text-decoration: none; display: inline-block;
        }
        .continue-button:hover { background-color: #4CAF50; }

        /* Cart Table */
        .cart-container { max-width: 900px; margin: 30px auto; background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #C4FFB6; font-weight: bold; }
        .total-row td { font-weight: bold; background-color: #E0F5E0; }

        .remove-button { background-color: #F44336; color: white; padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer; }
        .remove-button:hover { background-color: #D32F2F; }

        .continue-purchase-button {
            background-color: #5CB85C; color: white; padding: 10px 20px; font-size: 1em;
            border-radius: 25px; cursor: pointer; transition: background-color 0.3s;
        }
        .continue-purchase-button:hover { background-color: #4CAF50; }

        /* Flash Message */
        .flash-message {
            background-color:#C4FFB6;
            padding:10px;
            margin: 0 0 15px 0;
            border-radius:10px;
            text-align:center;
            font-weight:bold;
            color: #333;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modals */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); justify-content: center; align-items: center; }
        .modal-content { background-color: #C4FFB6; margin: auto; padding: 30px; border-radius: 15px; width: 80%; max-width: 500px; text-align: center; }
        .modal-buttons { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .modal-buttons button { padding: 15px 40px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer; font-size: 1.1em; transition: background-color 0.3s; }
        .confirm-yes { background-color: #5CB85C; color: white; }
        .confirm-yes:hover { background-color: #4CAF50; }
        .confirm-no { background-color: #F44336; color: white; }
        .confirm-no:hover { background-color: #D32F2F; }

        select, input {
            padding: 10px 15px;
            font-size: 1.1em;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 80%;
            max-width: 350px;
            margin: 5px auto 0 auto;
            display: block;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo">
    Caffè Sant’Antonio
</div>

<div class="cart-header-section">
    <div class="cart-actions-left">
        <button type="button" onclick="showCancelModal()">Cancel Purchase</button>
    </div>

    <h1>My Cart</h1>

    <div class="cart-actions-right">
        @if(session('last_subcategory_id'))
            <a href="{{ route('menu.subcategory.show', session('last_subcategory_id')) }}" class="continue-button">Continue Shopping</a>
        @else
            <a href="{{ route('menu.index') }}" class="continue-button">Continue Shopping</a>
        @endif
    </div>
</div>

<div class="cart-container">

    @if(session('status'))
        <div class="flash-message">{{ session('status') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItemsList as $item)
            <tr>
                <td>
                    {{ $item['name'] }}
                    @if(!empty($item['size']) && $item['size'] !== 'N/A')
                        ({{ $item['size'] }})
                    @endif
                </td>
                <td>{{ $item['quantity'] }}</td>
                <td>₱{{ number_format($item['price'], 2) }}</td>
                <td>₱{{ number_format($item['subtotal'], 2) }}</td>
                <td>{{ $item['order_date'] ?? now()->format('Y-m-d H:i:s') }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.remove') }}">
                        @csrf
                        <input type="hidden" name="cart_key" value="{{ $item['key'] }}">
                        <button type="submit" class="remove-button">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td>Total:</td>
                <td>{{ $totalItems }} {{ $totalItems === 1 ? 'Item' : 'Items' }}</td>
                <td></td>
                <td>₱{{ number_format($totalPrice, 2) }}</td>
                <td></td>
                <td style="text-align:right;">
                    <button type="button" class="continue-purchase-button" onclick="showPurchaseModal()">Continue Purchase</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Cancel Modal -->
<div id="cancelModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to cancel this purchase?</p>
        <div class="modal-buttons">
            <form action="{{ route('cart.cancel') }}" method="POST">
                @csrf
                <button type="submit" class="confirm-yes">Yes</button>
            </form>
            <button type="button" class="confirm-no" onclick="closeCancelModal()">No</button>
        </div>
    </div>
</div>

<!-- Purchase Modal -->
<div id="purchaseModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to purchase these items?</p>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div style="margin-bottom:15px; text-align:center;">
                <div style="margin-bottom:10px;">
                    <label for="gcash_name" style="display:block; margin-bottom:5px; font-weight:bold;">GCash Name:</label>
                    <input type="text" name="gcash_name" id="gcash_name" placeholder="Enter GCash name" required>
                </div>
                <div>
                    <label for="gcash_number" style="display:block; margin-bottom:5px; font-weight:bold;">GCash Number:</label>
                    <input type="text" name="gcash_number" id="gcash_number" placeholder="Enter GCash number" required>
                </div>
            </div>
            <input type="hidden" name="payment_method" value="GCash">
            <div class="modal-buttons">
                <button type="button" class="confirm-no" onclick="closePurchaseModal()">Cancel</button>
                <button type="submit" class="confirm-yes">Proceed</button>
            </div>
        </form>
    </div>
</div>

<script>
const purchaseModal = document.getElementById('purchaseModal');
const cancelModal = document.getElementById('cancelModal');

function showPurchaseModal() { purchaseModal.style.display = 'flex'; }
function closePurchaseModal() { purchaseModal.style.display = 'none'; }

function showCancelModal() { cancelModal.style.display = 'flex'; }
function closeCancelModal() { cancelModal.style.display = 'none'; }

window.onclick = function(event) {
    if(event.target === purchaseModal) closePurchaseModal();
    if(event.target === cancelModal) closeCancelModal();
}
</script>

</body>
</html>
