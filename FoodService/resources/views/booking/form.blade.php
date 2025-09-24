<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Form for Booking</title>
    <style>
        .chef-option {
            cursor: pointer;
            margin-right: 15px;
            text-align: center;
        }
        .chef-option input[type="radio"] {
            display: none;
        }
        .chef-option img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid transparent;
            transition: border-color 0.3s;
        }
        .chef-option input[type="radio"]:checked + img {
            border-color: #28a745;
        }
        .chef-name {
            margin-top: 5px;
            font-weight: 500;
        }
    </style>
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Book: {{ $experience->title }}</h2>
    <p>{{ $experience->description }}</p>

    @php
        $images = [
            'Local BBQ Meat Feast' => 'https://www.maggi.ph/sites/default/files/styles/home_stage_944_531/public/srh_recipes/ce6956d84add1c44699c8bf8443b590a.jpg?h=476030cb&itok=2K03esKf',
            'Fresh Vegetable Salad Tour' => 'https://amici.ph/cdn/shop/products/caesargrande.jpg?v=1663155911',
            'Cold-Pressed Juice Party' => 'https://www.whiskaffair.com/wp-content/uploads/2021/01/Apple-Iced-Tea-2-3.jpg',
            'Tropical Shake-Making Class' => 'https://tastyoven.com/wp-content/uploads/2022/06/mango-shake-image-500x375.jpeg',
        ];
        $imageUrl = $images[$experience->title] ?? null;

        $chefs = [
            ['name' => 'Irish', 'image' => 'https://i.imgur.com/PAPQzyl.jpeg', 'role' => 'Chef'],
            ['name' => 'Noah', 'image' => 'https://i.imgur.com/SSRvIPM.jpeg', 'role' => 'Chef'],
            ['name' => 'Marco', 'image' => 'https://i.imgur.com/3QLjA7V.jpeg', 'role' => 'Chef'],
            ['name' => 'Robbie', 'image' => 'https://i.imgur.com/7jpS3FQ.jpeg', 'role' => 'Chef'],
        ];
    @endphp

    @if($imageUrl)
        <img src="{{ $imageUrl }}" alt="{{ $experience->title }} image" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
    @endif

    <p><strong>Service Fee:</strong> ₱{{ $experience->price }}</p>

    <form method="POST" action="{{ route('booking.submit') }}">
        @csrf
        <input type="hidden" name="experience_id" value="{{ $experience->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>

        <div class="mb-3">
        <label for="date" class="form-label">Date:</label>
        <input type="date" id="date" name="date" required class="form-control" style="max-width: 250px;">
        </div>

        <div class="mb-3">
        <label class="form-label">Select Time Schedule:</label>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="time_slot" id="slotA" value="7:00 AM - 10:00 AM" required>
        <label class="form-check-label" for="slotA">
            Option A: 7:00 AM - 10:00 AM
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="time_slot" id="slotB" value="11:00 AM - 1:00 PM">
        <label class="form-check-label" for="slotB">
            Option B: 11:00 AM - 1:00 PM
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="time_slot" id="slotC" value="2:00 PM - 4:00 PM">
        <label class="form-check-label" for="slotC">
            Option C: 2:00 PM - 4:00 PM
        </label>
        </div>
        </div>

        <p><strong>Chef:</strong>  {{ $chef->name }} ({{ $chef->role }})</p>


        <div class="d-flex justify-content-start mt-3">
   <button type="submit" class="btn btn-outline-success"> Confirm Booking</button>
 </div>
    </form>

    <a href="{{ route('tours') }}">← Back to Food Tours</a>
</div>

@endsection
</body>
</html>
