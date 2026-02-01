<!DOCTYPE html>
<html>
<head>
    <title>Menu Page (Customer)</title>
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

        /* Logo and Name Container */
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
        
        /* Buttons */
        .button-group {
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        .return-button, .return-cart-button {
            background-color: #5CB85C;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
        }
        
        .return-button:hover, .return-cart-button:hover {
            background-color: #4CAF50; 
        }

        /* Main Menu Grid */
        .menu-grid {
            max-width: 900px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 20px;
        }

        /* Menu Category Item */
        .menu-item {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .menu-item-image {
            width: 100%;
            height: 150px;
            background-color: #D3D3D3;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            color: #A9A9A9;
            overflow: hidden;
        }
        
        .menu-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .menu-item-button {
            background-color: #5CB85C;
            color: white;
            padding: 15px 10px;
            font-size: 1.2em;
            font-weight: bold;
            border: none;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .menu-item-button:hover {
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
    <div class="button-group">
        <a href="{{ route('cart.index') }}" class="return-cart-button">View Cart</a>
        <a href="{{ url('/home') }}" class="return-button">Return to Homepage</a>
    </div>
</div>

<div class="menu-grid">
    @if($categories && $categories->count() > 0)
        @foreach($categories as $category)
           <a href="{{ route('menu.category', $category->id) }}" class="menu-item">
               <div class="menu-item-image">
                   @php
                       $categoryImages = [
                           'Starters' => 'Starters.jpg',
                           'Main' => 'Main.jpg',
                       ];
                       $imageFile = $categoryImages[$category->name] ?? strtolower($category->name) . '.home.jpg';
                   @endphp
                   <img src="{{ asset('images/' . $imageFile) }}" alt="{{ $category->name }}">
               </div>
               <div class="menu-item-button">{{ $category->name }}</div>
           </a>
        @endforeach
    @else
        <p style="grid-column: span 3; text-align:center;">No categories found.</p>
    @endif
</div>

</body>
</html>
