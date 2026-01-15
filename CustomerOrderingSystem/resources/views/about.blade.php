<!DOCTYPE html>
<html>
<head>
    <title>About Page - Caffè Sant’Antonio</title>
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
            width: 40px; /* Small logo size */
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

        /* Main Content Section */
        .content-section {
            padding: 20px 10%; /* Padding for the main content area */
        }
        
        /* About Heading */
        .content-section h1 {
            font-size: 3em;
            color: #333;
            margin-top: 20px;
            margin-bottom: 30px;
            padding-left: 20px; /* Aligns with text box padding */
        }

        /* Text Box Styling (Light Blue Border) */
        .about-text-box {
            border: 2px solid #ADD8E6; /* Light blue border */
            padding: 30px;
            line-height: 1.6;
            background-color: white; /* Ensures text is readable */
            font-size: 28px;
            color: #444;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); /* Subtle shadow */
        }
        
        .about-text-box p {
            margin-bottom: 1.5em; /* Space between paragraphs */
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

<div class="content-section">
    <h1>About:</h1>

    <div class="about-text-box">
        <p>The café features a warm brown façade with pendant lamps and showcases religious images, reflecting its ties to the nearby Rogationist School of Saint Anthony. Inside, cakes and pastries are displayed, while a side door leads to a charming pizzeria with red-brick walls, rustic interiors, and a wood-fired oven visible through the glass ceiling.</p>

        <p>The pizzas, prepared fresh by skilled hands, include bestsellers like Salsiccia (beefy with star anise), Melanzane (creamy eggplant), Puttanesca (sweet and tangy), and Vegetariana (with fresh greens). The pizzeria was founded by priests, led by Father Rene Ramirez, who wanted to recreate authentic Roman pizza. Their congregation, the Rogationists of the Heart of Jesus, originally made religious images, which explains the saint displays.</p>

        <p>The café opened in **2012**, followed by the pizzeria in **2013**, both built on repurposed space once used as a coffee storage. The wood-fired brick oven is central, not only for pizzas but also for dishes like Porchetta, slow-roasted using residual heat.</p>

        <p>Every detail—from the handcrafted plates and mugs to the food and setting—reflects artistry, devotion, and care, making the experience feel both rustic and divine.</p>
    </div>
</div>

</body>
</html>