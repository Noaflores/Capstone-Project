<!DOCTYPE html>
<html>
<head>
    <title>Profile Page (Edit)</title>
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
        
        /* Main Profile Content Area */
        .profile-content {
            max-width: 900px;
            margin: 50px auto; /* Center the content */
            padding: 30px;
            display: flex;
            gap: 40px; /* Space between the profile image and info */
            align-items: flex-start; /* Align items to the top */
            position: relative; /* For positioning buttons */
        }
        
        /* Profile Image Placeholder */
        .profile-image-placeholder {
            width: 200px;
            height: 200px;
            background-color: #D3D3D3; /* Gray background */
            border-radius: 10px; /* Slightly rounded corners */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 100px; /* Large person icon */
            color: #A9A9A9; /* Lighter gray icon */
        }

        /* User Info Grid for Labels and Inputs */
        .user-info-grid {
            display: grid;
            grid-template-columns: auto 1fr; /* Label column, then input column */
            gap: 20px 15px; /* Row gap, column gap */
            flex-grow: 1; /* Allows it to take available space */
            align-items: center; /* Vertically align labels and inputs */
        }

        .info-label {
            font-size: 1.1em;
            font-weight: normal;
            color: #333;
            text-align: right; /* Align labels to the right */
            white-space: nowrap; /* Prevent label wrapping */
        }

        .info-input-wrapper {
            /* For the input fields which look like styled buttons */
            background-color: #D3D3D3; /* Gray background */
            padding: 10px 15px;
            border-radius: 25px; /* Fully rounded corners */
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
            text-align: left;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); /* Inner shadow for depth */
            display: flex; /* Allow input to fill */
        }

        .info-input-wrapper input {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
            color: #333;
            padding: 0;
            margin: 0;
        }

        /* Buttons at the bottom */
        .button-group {
            position: absolute; /* Position relative to profile-content */
            right: 30px; 
            bottom: -50px; /* Position below the main info grid */
            display: flex;
            gap: 15px;
        }

        .action-button {
            background-color: #D3D3D3; /* Gray background */
            color: #333;
            padding: 10px 30px;
            border-radius: 25px;
            font-size: 1.2em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #C0C0C0; /* Slightly darker on hover */
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="logo-container">
        <img src="{{ asset('images/cafelogowbg.png') }}" alt="Café Logo" class="logo">
        Caffè Sant’Antonio
    </div>
    </div>

<div class="profile-content">
    <div class="profile-image-placeholder">
        &#128100; 
    </div>
    
    <form method="POST" action="{{ route('profile.update') }}" class="user-info-grid">
        @csrf
        
        <div class="info-label">First and Last Name:</div>
        <div class="info-input-wrapper">
            <input type="text" name="name" value="{{ $user->name}}">
        </div>

        <div class="info-label">Email:</div>
        <div class="info-input-wrapper">
            <input type="email" name="email" value="{{ $user->email}}">
        </div>

        <div class="info-label">Contact Number:</div>
        <div class="info-input-wrapper">
            <input type="text" name="contact_number" value="{{ $user->contact_number}}">
        </div>

        <div class="button-group">
            <a href="{{ route('profile') }}" class="action-button">Cancel</a>
            <button type="submit" class="action-button">Change</button>
        </div>
    </form>
</div>

</body>
</html>