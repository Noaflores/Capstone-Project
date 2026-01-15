<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Caffè Sant’Antonio</title>
    <style>
        body {
           background-image: url('{{ asset('images/FoodBG.jpg') }}');
            background-size: cover;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .card {
            width:350px;
            padding:25px;
            background:white;
            border-radius:30px;
            text-align:center;
        }
        input { width:90%; margin:5px 0; padding:8px; border-radius: 15px; }
        button { width:95%; padding:8px; background:#A76545; color:white; border-radius: 15px;}
        a { font-size:14px;}
    </style>
</head>
<body>
<div class="card">
    <img src="{{ asset('images/CafeLogo.jpg') }}" alt="Café Logo" class="logo" width="300">
    <h3>Sign Up</h3>

    <form method="POST" action="{{ route('signup.perform') }}">
    @csrf
    
    @if ($errors->any())
        <div style="color: red; font-size: 12px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
    <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
    <input type="text" name="contact_number" placeholder="Contact Number" value="{{ old('contact_number') }}" required>
    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    
    <button type="submit">Sign Up</button>
</form>

    <p>Already have an account? <a href="/login">Login</a></p>
</div>
<script>
    function togglePasswordVisibility() {
        // Get the password input field using its ID
        const passwordInput = document.getElementById('password');
        
        // Check the current type and switch it
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
</body>
</html>
