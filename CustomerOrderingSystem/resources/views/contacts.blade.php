<!DOCTYPE html>
<html>
<head>
    <title>Contacts - Caffè Sant’Antonio</title>
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
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .return-button:hover {
            background-color: #4CAF50; 
        }

        /* Contacts Heading Section */
        .heading-section {
            background-color: #E0F5E0; /* Slightly different green */
            padding: 20px 10%;
            margin-bottom: 20px;
        }
        
        .heading-section h1 {
            font-size: 3em;
            color: #333;
            margin: 0;
            padding-left: 10px;
            /* Blue border/box effect shown in the image */
            border: 2px solid #ADD8E6; 
            display: inline-block;
            padding: 5px 15px;
        }
        
        /* Contact Information Box */
        .contact-info-box {
            background-color: #E0F5E0; /* Light green background for the box */
            padding: 30px;
            margin: 0 10%;
            border-radius: 10px;
            font-size: 48px;
            line-height: 1.8;
            color: #333;
            /* Using serif font to match the elegant look in the image */
            font-family: 'Times New Roman', Times, serif; 
        }

        .contact-info-box strong {
            display: block;
            margin-top: 15px;
        }
        
        .contact-info-box a {
            color: #5CB85C;
            text-decoration: none;
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

<div class="heading-section">
    <h1>Contacts:</h1>
</div>

<div class="contact-info-box">
    
    <p>Follow us on:</p>
    <p><a href="https://www.facebook.com/CaffeSantAntonio" target="_blank">https://www.facebook.com/CaffeSantAntonio</a></p>
    
    <p>Contact No # 0956 487 5493</p>
    
    <p>Address: 51.8 Km, Aguinaldo Highway, Lalaan ll, Silang, Cavite, Philippines</p>
</div>

</body>
</html>