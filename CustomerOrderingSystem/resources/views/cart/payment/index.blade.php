<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Cart - Caffè Sant’Antonio</title>
<style>
    body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }
    .top-bar { background-color: #C4FFB6; padding: 10px 20px; display: flex; align-items: flex-start; justify-content: space-between; }
    .top-bar-left { display: flex; flex-direction: column; gap: 10px; }
    .top-bar-right { display: flex; align-items: center; margin-top: 50px; }
    .logo { display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 1.2em; }
    .btn { background-color: #5CB85C; color: white; padding: 8px 15px; border-radius: 25px; text-decoration: none; font-weight: bold; text-align: center; display: inline-block; border: 2px solid #010201; cursor:pointer; }
    .btn:hover { background-color: #4CAF50; }
    .btn-cancel { background-color: #F44336; }
    .btn-cancel:hover { background-color: #D32F2F; }
    .cart-container { max-width: 900px; margin: 20px auto 30px auto; background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; vertical-align: top; }
    th { background-color: #C4FFB6; font-weight: bold; }
    .total-row td { font-weight: bold; background-color: #E0F5E0; }
    .remove-button { background-color: #F44336; color: white; padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer; }
    .remove-button:hover { background-color: #D32F2F; }
    .flash-message { background-color: #C4FFB6; padding: 10px; margin: 0 0 15px 0; border-radius: 10px; text-align: center; font-weight: bold; color: #333; max-width: 900px; margin-left: auto; margin-right: auto; }
    select { font-size: 1em; }
    #proceedBtn:disabled {background-color: #A5D6A7; cursor: not-allowed;opacity: 0.6; 
}

</style>
</head>
<body>

<div class="top-bar">
    <div class="top-bar-left">
        <div class="logo">
            <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo" style="width:40px;">
            Caffè Sant’Antonio
        </div>
        <form action="{{ route('cart.cancel') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-cancel">Cancel Purchase</button>
        </form>
    </div>

    <div class="top-bar-right">
        @if(session('last_subcategory_id'))
            <a href="{{ route('menu.subcategory.show', session('last_subcategory_id')) }}" class="btn">Continue Shopping</a>
        @else
            <a href="{{ route('menu.index') }}" class="btn">Continue Shopping</a>
        @endif
    </div>
</div>

<div class="cart-container">

    @if(session('status'))
        <div class="flash-message">{{ session('status') }}</div>
    @endif

    @if(!empty($cartItemsList) && count($cartItemsList) > 0)
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItemsList as $key => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['size'] ?? 'N/A' }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>₱{{ number_format($item['price'], 2) }}</td>
                <td>₱{{ number_format($item['subtotal'], 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_key" value="{{ $key }}">
                        <button type="submit" class="remove-button">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td>Total:</td>
                <td></td>
                <td>{{ $totalItems }} {{ $totalItems === 1 ? 'Item' : 'Items' }}</td>
                <td></td>
                <td>₱{{ number_format($totalPrice, 2) }}</td>
                <td>
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit" id="proceedBtn" class="btn" disabled style="width:100%; margin-bottom:10px;">
            Proceed to Payment
        </button>

        <label for="payment_method" style="display:block; margin-bottom:5px;">Payment Method:</label>
        <select name="payment_method" id="paymentMethod" class="border px-3 py-2 rounded w-full" required>
            <option value=""> Select Payment Method </option>
            <option value="GCash">GCash</option>
            <option value="COD">Cash on Delivery</option>
        </select>
    </form>
</td>

            </tr>
        </tfoot>
    </table>

    @else
        <p style="text-align:center; font-weight:bold;">Your cart is empty.</p>
        <div style="text-align:center; margin-top:15px;">
        </div>
    @endif
</div>

<script>
const paymentSelect = document.getElementById('paymentMethod');
const proceedBtn = document.getElementById('proceedBtn');

paymentSelect.addEventListener('change', function() {
    proceedBtn.disabled = this.value === '';
    if (this.value === 'COD') {
        proceedBtn.textContent = 'Proceed to COD Payment';
    } else if (this.value === 'GCash') {
        proceedBtn.textContent = 'Proceed to GCash Payment';
    } else {
        proceedBtn.textContent = 'Proceed to Payment';
    }
});
</script>


</body>
</html>
