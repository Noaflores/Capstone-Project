<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Class Schedules</title>
    <style>
        .check-details-btn {
            border: 2px solid #0a5c2d;
            color: rgb(17, 126, 0);
            background-color: transparent;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .check-details-btn:hover {
            background-color:rgb(27, 182, 0);
            color: #fff;
        }

        .class-image {
            width: 90%;
            max-width: 300px;
            height: 180px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .schedule-card {
            border: 1px solid #ccc; 
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.2s;
            background-color: #fff;
            padding: 20px; 
            max-width: 500px; 
            margin: 0 auto;
        }

        .schedule-card:hover {
            transform: scale(1.02);
        }

        .schedule-card img {
            height: 160px;
            width: 100%;
            object-fit: cover;
            object-position: center;
            margin-bottom: 10px;
            border-radius: 12px;
        }

        .schedule-card .card-body {
            padding: 1rem;
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold" style="font-size: 2.5rem;">
        Upcoming Cooking Classes
    </h2>

    <div class="row justify-content-center">
        @php use Illuminate\Support\Str; @endphp

            @foreach($classes->unique(fn($item) => $item->experience->title) as $class)
            @php
                $title = $class->experience->title ?? 'Cooking Class';
                $imageMap = [
                    'Meat' => 'meat.jpg',
                    'Vegetable' => 'vegetable.jpg',
                    'Juice' => 'juice.jpg',
                    'Shake' => 'shake.jpg',
                ];

                $matchedImage = $imageMap[$title] ?? 'default.jpg';

                foreach ($imageMap as $keyword => $imageFile) {
                    if (Str::contains($title, $keyword)) {
                        $matchedImage = $imageFile;
                        break;
                    }
                }
            @endphp

            <div class="col-md-6 mb-5">
                <div class="card schedule-card h-100 text-center">
                    <img src="{{ asset('images/' . $matchedImage) }}"
                         alt="{{ $class->experience->title }}"
                         class="class-image mx-auto d-block" />

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $title }}</h5>

                        <p class="mb-3">
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($class->date)->format('F j, Y') }}
                        </p>

                        <a href="{{ route('cooking-classes.show', ['id' => $class->id]) }}"
                           class="check-details-btn">
                            Check Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
</body>
</html>
