<!DOCTYPE html>
<html>
<head>
    <title>Home Page (Customer)</title>
    <style>
        body { 
            font-family: Georgia, serif; 
            margin: 0;
            background-color: #F0F0F0;
        }
        
        /* The main container for the header content */
        .top-bar {
            background-color: #C4FFB6; 
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Styling for the logo and café name container */
        .logo-container {
            display: flex;
            align-items: center;
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
        }

        .logo-container img {
            width: 50px;
            margin-right: 10px;
        }
        
        /* Navigation Links (Buttons) */
        nav a,
        nav button {
            background-color: #5CB85C;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            margin-left: 10px;
            font-size: 1em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        nav a:hover,
        nav button:hover {
            background-color: #4CAF50;
        }
        
        /* Main Welcome Section Styling */
        .welcome-section {
            background-color: #E0F5E0;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome-section h1 {
            font-size: 2.2em;
            margin: 0;
            color: #333;
        }
        
        .welcome-section h2 {
            font-size: 1.2em;
            margin-bottom: 5px;
            font-weight: normal;
            color: #666;
        }

        /* Styling for the main content image */
        .main-content img {
            max-width: 80%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Café Logo" class="logo">
        Caffè Sant’Antonio
    </div>
    <nav>
        <a href="{{ route('menu.index') }}">Menu</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('profile') }}">User Profile</a>
        <a href="{{ route('contacts') }}">Contacts</a> 
        <!-- Cart button removed -->
    </nav>
</div>

<div class="welcome-section">
    <h2>WELCOME TO</h2>
    <h1>Caffè Sant’Antonio</h1>
</div>

<div class="main-content" style="text-align:center;">
    <img src="{{ asset('images/interiorbg.jpg') }}" alt="Interior">
</div>

</body>
</html>
