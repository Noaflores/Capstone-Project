<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $subcategory->name ?? 'Menu' }} - Caffè Sant’Antonio</title>
<style>
    body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }
    .top-bar { background-color: #C4FFB6; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
    .top-bar h1 { margin: 0; }
    .btn { background-color: #5CB85C; color: white; padding: 8px 15px; border-radius: 20px; text-decoration: none; margin-left: 10px; }
    .content { padding: 40px; }
    .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; }
    .item-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .item-image-card { height: 250px; background-color: #DDD; text-align: center; overflow:hidden; }
    .item-image-card img { width: 100%; height: 100%; object-fit: cover; }
    .item-title { font-size: 1.4em; font-weight: bold; margin: 10px; text-align: center; }
    .description-box { background-color: #D3D3D3; padding: 20px; border-radius: 15px; margin: 10px; }
    .size-container { margin: 15px 0; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .size-options input[type="radio"] { display: none; }
    .size-label { padding: 6px 15px; background: #fff; border-radius: 20px; cursor: pointer; font-weight: bold; border: 2px solid transparent; }
    .size-options input[type="radio"]:checked + .size-label { background-color: #C4FFB6; border-color: #76c766; }
    .item-price-quantity { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin-top: 15px; gap: 10px; }
    .price { font-size: 1.2em; font-weight: bold; }
    .quantity-button { background-color: #A9A9A9; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; }
    .action-buttons-group { margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px; }
    .btn-submit { background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 20px; border: none; font-weight: bold; cursor: pointer; }
    .btn-return { text-decoration: none; color: #555; font-weight: bold; padding: 10px; border-radius: 15px; border: 1px solid #ccc; }
    .flash-message { background-color:#C4FFB6; padding:10px; margin:20px 0; border-radius:10px; text-align:center; font-weight:bold; color: #333; }
</style>
</head>
<body>

<div class="top-bar">
    <h1>{{ $subcategory->name ?? 'Menu' }}</h1>
    <div>
        <a href="{{ route('menu.category', $subcategory->category_id ?? 1) }}" class="btn">Back to Category</a>
        <a href="{{ route('menu.index') }}" class="btn">Menu</a>
    </div>
</div>

<div class="content">
    @if(session('status'))
        <div class="flash-message">{{ session('status') }}</div>
    @endif

    @if(!empty($items) && $items->count() > 0)
        <div class="menu-grid">
            @foreach($items as $item)
                @php
                    $sizeItems = ['italian hot coffee','espresso','mocha frappe','frappe con caffe','frappe al latte','caramel frappe','vanilla latte frappe','hazelnut latte frappe'];
                    $itemName = strtolower(trim($item->name));
                    $hasSize = in_array($itemName, $sizeItems);
                @endphp

                <div class="item-card">
                    <div class="item-image-card">
                        <img src="{{ $item->image_path ? asset('images/items/' . $item->image_path) : asset('images/items/placeholder.png') }}" 
                             alt="{{ $item->name }}" 
                             onerror="this.src='{{ asset('images/items/placeholder.png') }}';">
                    </div>

                    <div class="item-title">{{ $item->name }}</div>

                    <div class="description-box">
                        <p>{{ $item->description ?? '' }}</p>

                        <form method="POST" action="{{ route('cart.add') }}">
    @csrf
    <!-- Must be item_id to match CartController -->
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <input type="hidden" name="name" value="{{ $item->name }}">
    <input type="hidden" name="price" id="price_input_{{ $item->id }}" value="{{ $item->price }}">
    <input type="hidden" name="quantity" id="quantity_input_{{ $item->id }}" value="1">

    @if($hasSize)
        <div class="size-container">
            <strong>Select Size:</strong>
            <div class="size-options">
                <input type="radio" id="medio_{{ $item->id }}" name="size" value="Medio" checked data-price="{{ $item->price }}">
                <label for="medio_{{ $item->id }}" class="size-label">Medio</label>

                <input type="radio" id="grande_{{ $item->id }}" name="size" value="Grande" data-price="{{ round($item->price * 1.0833, 2) }}">
                <label for="grande_{{ $item->id }}" class="size-label">Grande</label>
            </div>
        </div>
    @else
        <input type="hidden" name="size" value="N/A">
    @endif

    <div class="item-price-quantity">
        <div class="price" id="price_display_{{ $item->id }}">₱{{ number_format($item->price, 2) }}</div>
        <div>
            <button type="button" class="quantity-button" onclick="changeQuantity({{ $item->id }}, -1)">-</button>
            <span id="quantity_display_{{ $item->id }}">1</span>
            <button type="button" class="quantity-button" onclick="changeQuantity({{ $item->id }}, 1)">+</button>
        </div>
    </div>

    <div class="action-buttons-group">
        <button type="submit" class="btn-submit">Add to Cart</button>
    </div>
</form>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="text-align:center;">No items found.</p>
    @endif
</div>

<script>
let quantities = {};
function changeQuantity(id, change) {
    quantities[id] = (quantities[id] || 1) + change;
    if (quantities[id] < 1) quantities[id] = 1;
    document.getElementById('quantity_display_' + id).textContent = quantities[id];
    document.getElementById('quantity_input_' + id).value = quantities[id];
}

// Update price dynamically when size changes
document.querySelectorAll('.size-options input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const itemId = this.id.split('_')[1];
        const newPrice = parseFloat(this.dataset.price);
        document.getElementById('price_display_' + itemId).textContent = '₱' + newPrice.toFixed(2);
        document.getElementById('price_input_' + itemId).value = newPrice;
    });
});
</script>
</body>
</html>
