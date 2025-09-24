<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Detail Page</title>
    <style>
        .class-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            object-fit: cover;
            border-radius: 12px;
            margin: 0 auto 20px;
            display: block;
        }

        .back-btn {
            border: 2px solid #0a5c2d;
            color: #0a5c2d;
            background-color: transparent;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background-color: #0a5c2d;
            color: #fff;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4 text-center">
        <h2 class="fw-bold mb-3">{{ $class->experience->title }}</h2>

        @php
            use Illuminate\Support\Str;
            $imageMap = [
                'Meat' => 'meat.jpg',
                'Vegetable' => 'vegetable.jpg',
                'Juice' => 'juice.jpg',
                'Shake' => 'shake.jpg',
            ];

            $matchedImage = 'default.jpg';
            foreach ($imageMap as $keyword => $imageFile) {
                if (Str::contains($class->experience->title, $keyword)) {
                    $matchedImage = $imageFile;
                    break;
                }
            }
        @endphp

        <img src="{{ asset('images/' . $matchedImage) }}" alt="{{ $class->experience->title }}" class="class-image">

        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($class->date)->format('F j, Y') }}</p>

        @php
        $title = $class->experience->title ?? 'Cooking Class';
        $timeSlotMap = [
        'Cold-Pressed Juice Party' => '11:00 AM - 1:00 PM',
        'Vegetable Cooking' => '7:00 AM - 10:00 AM',
        'Shake Delight' => '2:00 PM - 4:00 PM',
        'Meat Masterclass' => '7:00 AM - 10:00 AM',
        ];

        $timeSlot = $timeSlotMap[$title] ?? 'TBD';
        @endphp

        <p><strong>Time:</strong> {{ $timeSlot }}</p>
        <p><strong>Chef in Charge:</strong> {{ $assignedChef }}</p>

        <a href="{{ route('cooking-classes.index') }}" class="back-btn mt-3">Back to Class Schedule</a>
    </div>
</div>
@endsection
</body>
</html>
