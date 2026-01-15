    <!DOCTYPE html>
    <html>
    <head>
        <title>Menu Page (Customer)</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                margin: 0; 
                background-color: #F0F0F0; /* Light gray background */
            }
            
            /* Top Header Bar */
            .top-bar {
                background-color: #C4FFB6; /* Light green background */
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
            
            /* Return to Homepage Button */
            .return-button {
                background-color: #5CB85C; /* Darker, vibrant green */
                color: white;
                text-decoration: none;
                padding: 10px 18px;
                border-radius: 25px; /* Fully rounded */
                font-size: 1em;
                font-weight: bold;
                border: none;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            
            .return-button:hover {
                background-color: #4CAF50; 
            }

            /* Main Menu Grid */
            .menu-grid {
                max-width: 900px;
                margin: 50px auto; /* Center the grid */
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* 3 columns */
                gap: 30px; /* Space between items */
                padding: 20px;
            }

            /* Menu Category Item */
            .menu-item {
                background-color: white; /* White background for the card */
                border-radius: 15px; /* Rounded corners */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden; /* Ensures image corners are rounded */
                text-align: center;
                display: flex; /* For vertical alignment of image and text */
                flex-direction: column;
                justify-content: space-between; /* Push button to bottom */
                cursor: pointer;
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .menu-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            }

            .menu-item-image {
                width: 100%;
                height: 150px; /* Fixed height for images */
                background-color: #D3D3D3; /* Gray placeholder */
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 3em;
                color: #A9A9A9;
                overflow: hidden; /* Hide parts of image if it overflows */
            }
            
            .menu-item-image img {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Cover the area, crop if necessary */
                display: block;
            }

            .menu-item-button {
                background-color: #5CB85C; /* Green button */
                color: white;
                padding: 15px 10px;
                font-size: 1.2em;
                font-weight: bold;
                border: none;
                border-bottom-left-radius: 15px; /* Only bottom corners rounded */
                border-bottom-right-radius: 15px;
                cursor: pointer;
                text-decoration: none; /* Remove underline for links */
                display: block; /* Make link fill the button area */
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
    <a href="{{ url('/home') }}" class="return-button">Return to Homepage</a>
</div>

<div class="menu-grid">
    @foreach($categories as $category)
        {{-- Link to a dynamic route using the category ID or Name --}}
        <a href="{{ route('menu.category', $category->id) }}" class="menu-item">
            <div class="menu-item-image">
                {{-- Dynamic image path: assumes images are named like 'coffee.jpg' based on category name --}}
                <img src="{{ asset('images/' . strtolower($category->name) . '.home.jpg') }}" 
                     alt="{{ $category->name }}">
            </div>
            <div class="menu-item-button">{{ $category->name }}</div>
        </a>
    @endforeach
</div>

</body>
    </html>