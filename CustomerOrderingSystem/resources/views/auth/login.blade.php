<!DOCTYPE html>
<html>
<head>
    <title>Login - Caffè Sant’Antonio</title>
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
    <h2>Login</h2>

    @if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif

    <form method="POST" action="{{ route('login.perform') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" id="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

    <p>Don't have an account? <a href="/signup">Sign Up</a></p>
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
