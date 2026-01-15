<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - Caffè Sant’Antonio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }
        .top-bar { background-color: #C4FFB6; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo-container { display: flex; align-items: center; font-size: 1.5em; font-weight: bold; color: #333; }
        .logo-container img { width: 40px; margin-right: 10px; }
        .item-details-section { max-width: 900px; margin: 50px auto; padding: 20px; display: flex; flex-wrap: wrap; gap: 40px; }
        .item-image-card { background-color: white; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden; text-align: center; padding-bottom: 20px; width: 300px; }
        .item-image-card img { width: 100%; height: 250px; object-fit: cover; }
        .description-box { background-color: #D3D3D3; padding: 25px; border-radius: 15px; flex-grow: 1; min-width: 300px; }
        .size-container { margin: 20px 0; display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
        .size-options input[type="radio"] { display: none; }
        .size-label { padding: 8px 20px; background: #fff; border-radius: 20px; cursor: pointer; font-weight: bold; transition: 0.3s; border: 2px solid transparent; }
        .size-options input[type="radio"]:checked + .size-label { background-color: #C4FFB6; border-color: #76c766; }
        .item-price-quantity { display: flex; justify-content: space-between; align-items: center; margin-top: 25px; flex-wrap: wrap; gap: 10px; }
        .price { font-size: 1.4em; font-weight: bold; }
        .quantity-button { background-color: #A9A9A9; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; }
        .action-buttons-group { margin-top: 40px; display: flex; flex-wrap: wrap; align-items: center; gap: 20px; }
        .btn-submit { background-color: #4CAF50; color: white; padding: 12px 30px; border-radius: 25px; border: none; font-size: 1.1em; font-weight: bold; cursor: pointer; }
        .btn-return { text-decoration: none; color: #555; font-weight: bold; }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo">
        Caffè Sant’Antonio
    </div>
</div>

<div class="item-details-section">
    <!-- Item Image -->
    <div class="item-image-card">
        <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/placeholder.png') }}" alt="{{ $item->name }}">
        <div style="font-size: 1.5em; font-weight: bold; margin-top: 10px;">{{ $item->name }}</div>
    </div>

    <!-- Item Description and Add to Cart -->
    <div class="description-box">
        <h2>Description:</h2>
        <p>{{ $item->description }}</p>
        
        <form method="POST" action="{{ route('cart.confirm') }}">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <input type="hidden" name="base_price" value="{{ $item->price }}">
    <input type="hidden" name="quantity" id="quantity_input" value="1">

    <!-- size selection -->
    <div class="size-container">
        <strong>Select Size:</strong>
        <div class="size-options">
            <input type="radio" id="medio" name="size" value="Medio" checked>
            <label for="medio" class="size-label">Medio</label>

            <input type="radio" id="grande" name="size" value="Grande">
            <label for="grande" class="size-label">Grande</label>
        </div>
    </div>

    <div class="action-buttons-group">
        <button type="submit" class="btn-submit">Add to Cart</button>
        <a href="{{ route('menu.category', $item->sub_category_id) }}" class="btn-return">Return to Category</a>
    </div>
</form>

    </div>
</div>

<script>
    let quantity = 1;
    function changeQuantity(change) {
        quantity += change;
        if (quantity < 1) quantity = 1;
        document.getElementById('quantity_display').textContent = quantity;
        document.getElementById('quantity_input').value = quantity;
    }
</script>

</body>
</html>
