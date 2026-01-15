<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
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
        
        /* Header Buttons Container */
        .header-buttons {
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        /* Logout and Return to Homepage Buttons */
        .header-buttons a,
        .header-buttons button {
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
        
        .header-buttons a:hover,
        .header-buttons button:hover {
            background-color: #4CAF50; 
        }

        /* Main Profile Content Area */
        .profile-content {
            max-width: 900px;
            margin: 50px auto; /* Center the content */
            padding: 30px;
            display: flex;
            gap: 40px; /* Space between the profile image and info */
            align-items: flex-start; /* Align items to the top */
            position: relative; /* For positioning the edit button */
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

        /* User Info Grid */
        .user-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns for info */
            gap: 20px; /* Space between grid items */
            flex-grow: 1; /* Allows it to take available space */
        }

        .info-card {
            background-color: #D3D3D3; /* Gray background for info cards */
            padding: 15px 20px;
            border-radius: 25px; /* Fully rounded corners */
            text-align: center;
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
        }

        .info-card small {
            display: block;
            font-size: 0.8em;
            font-weight: normal;
            color: #666;
            margin-top: 5px;
        }

        /* Edit Button Styling */
        .edit-button {
            background-color: #D3D3D3; /* Gray background */
            color: #333;
            padding: 10px 30px;
            border-radius: 25px;
            font-size: 1.2em;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            position: absolute; /* Position relative to profile-content */
            right: 30px; /* Aligned with right edge of profile-content */
            bottom: -50px; /* Position below the main info grid */
        }

        .edit-button:hover {
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
    <div class="header-buttons">
       <form action="/logout" method="POST" style="display:inline;">
            @csrf
            <button>Logout</button>
        </form>
        <a href="{{ url('/home') }}" class="return-button">Return to Homepage</a>
    </div>
</div>

<div class="profile-content">
    <div class="profile-image-placeholder">
        &#128100; </div>
    
    <div class="user-info-grid">
        <div class="info-card">
            {{ $user->first_name}} {{ $user->last_name}}
            <small>First and Last Name</small>
        </div>
        <div class="info-card">
            UID{{ $user->customer_id }}
            <small>Customer ID</small>  
        </div>
        <div class="info-card">
            {{ $user->Email}}
            <small>Email</small>
        </div>
        <div class="info-card">
            {{ $user->contact_number}}
            <small>Contact Number</small>
        </div>
    </div>

    <a href="{{ route('profile.edit') }}" class="edit-button">Edit</a>
</div>

</body>
</html>