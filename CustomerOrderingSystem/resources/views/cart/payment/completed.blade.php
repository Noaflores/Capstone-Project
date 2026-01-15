<!DOCTYPE html>
<html>
<head>
    <title>Complete Payment Page (Customer)</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            background-color: #F0F0F0;
        }
        
        /* Top Header Bar */
        .top-bar {
            background-color: #C4FFB6; /* Light green background */
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
        
        /* Return to Homepage Button */
        .return-button {
            background-color: #5CB85C; /* Darker, vibrant green */
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 25px; /* Fully rounded */
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .return-button:hover {
            background-color: #4CAF50; 
        }

        /* Purchase Completed Box */
        .purchase-completed-box {
            max-width: 600px;
            margin: 80px auto; /* Center the box vertically and horizontally */
            background-color: #5CB85C; /* Green box as in image */
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 50px 30px;
            text-align: center;
            border: 2px solid #333; /* Darker border */
        }

        .purchase-completed-box h1 {
            font-size: 4em; /* Large text */
            color: white;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
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


<div class="purchase-completed-box">
    <h1>Purchase<br>Completed!</h1>
</div>

</body>
</html>