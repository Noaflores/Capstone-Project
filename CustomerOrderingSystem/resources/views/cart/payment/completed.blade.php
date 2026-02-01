<x-app-layout>
    <x-slot name="title">Payment Completed</x-slot>

    <style>
        body { font-family: Arial, sans-serif; margin:0; background-color:#F0F0F0; }

        /* Full-width top bar */
        .top-bar {
            background-color: #C4FFB6;
            width: 100%;
            padding: 12px 30px;
            box-sizing: border-box;
        }
        .top-bar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            display: flex;
            align-items: center;
            gap:10px;
            font-weight:bold;
            font-size:1.2em;
        }
        .logo img { width:40px; }

        .return-button {
            background-color:#5CB85C;
            color:white;
            padding:10px 25px;
            border-radius:25px;
            font-weight:bold;
            text-decoration:none;
            transition: background 0.3s;
        }
        .return-button:hover { background-color:#4CAF50; }

        .purchase-completed-box {
            max-width:600px;
            margin:80px auto;
            background-color:#5CB85C;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
            padding:50px 30px;
            text-align:center;
            border:2px solid #333;
        }
        .purchase-completed-box h1 {
            font-size:4em;
            color:white;
            font-weight:bold;
            margin:0;
            line-height:1.2;
        }
    </style>

    <div class="top-bar">
        <div class="top-bar-inner">
            <div class="logo">
                <img src="{{ asset('images/cafelogowbg.png') }}" alt="Café Logo">
                Caffè Sant’Antonio
            </div>
            <a href="{{ url('/home') }}" class="return-button">Return to Homepage</a>
        </div>
    </div>

    <div class="purchase-completed-box">
        <h1>Purchase<br>Completed!</h1>
    </div>
</x-app-layout>
