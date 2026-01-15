<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} - Caffè Sant’Antonio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #F0F0F0; }
        .top-bar { background-color: #C4FFB6; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo-container { display: flex; align-items: center; font-size: 1.5em; font-weight: bold; color: #333; }
        .logo-container img { width: 40px; margin-right: 10px; }
        .return-button { background-color: #5CB85C; color: white; text-decoration: none; padding: 10px 18px; border-radius: 25px; font-size: 1em; font-weight: bold; border: none; cursor: pointer; transition: background-color 0.3s; }
        .menu-grid { max-width: 900px; margin: 50px auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 20px; }
        
        /* Clickable Item Card */
        .item-link { text-decoration: none; color: inherit; display: block; }
        .menu-item { background-color: white; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; text-align: center; height: 100%; transition: transform 0.2s; }
        .menu-item:hover { transform: translateY(-5px); }
        .menu-item-image { width: 100%; height: 150px; background-color: #D3D3D3; }
        .menu-item-image img { width: 100%; height: 100%; object-fit: cover; }
        .menu-item-button { background-color: #5CB85C; color: white; padding: 15px 10px; font-size: 1.2em; font-weight: bold; }
        
        .btn-container { display: flex; gap: 10px; }
        .back-btn { background-color: #888; }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
         <img src="{{ asset('images/cafelogowbg.png') }}" alt="Logo">
         {{ $category->name }} 
    </div>
    <div class="btn-container">
        <a href="{{ url('/menu') }}" class="return-button back-btn">Back to Menu</a>
        <a href="{{ url('/home') }}" class="return-button">Homepage</a>
    </div>
</div>

<div class="menu-grid">
    @forelse($items as $item)
    <a href="{{ route('item.show', $item->id) }}" class="item-link">
        <div class="menu-item">
            <div class="menu-item-image">
                <img src="{{ asset('images/items/' . strtolower(str_replace(' ', '_', $item->name)) . '.jpg') }}" 
                     alt="{{ $item->name }}">
            </div>
            <div class="menu-item-button">
                {{ $item->name }}
                <div style="font-size: 0.6em; font-weight: normal; margin-top: 5px; opacity: 0.9;">
                    {{ Str::limit($item->description, 50) }}
                </div>
            </div>
        </div>
    </a>
@empty
    <p style="grid-column: span 3; text-align: center;">No items found in this category.</p>
@endforelse

</div>

</body>
</html>