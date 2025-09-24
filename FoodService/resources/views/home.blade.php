<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Service Project</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-50 via-rose-100 to-pink-200 min-h-screen text-gray-800">

@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center py-20 px-6 text-center">
    
   
    <h1 class="text-5xl md:text-6xl font-extrabold text-red-600 drop-shadow-lg mb-6 animate-pulse">
        🍴 Food Service Project
    </h1>
    
 
    <p class="text-lg md:text-xl max-w-3xl text-gray-700 mb-10 leading-relaxed">
        Explore exclusive food tours, hands-on cooking classes, and one-on-one chef experiences—all guided by passionate culinary artists.
    </p>
    
    
    <div class="overflow-hidden rounded-3xl shadow-2xl mb-10 transform transition hover:scale-105 duration-300">
        <img src="{{ asset('images/FoodTourPreview.gif') }}" alt="Food Tour Preview" class="w-full max-w-lg h-auto">
    </div>

   
    <a href="{{ route('tours') }}" 
       class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold text-lg px-8 py-3 rounded-full shadow-lg transition-all duration-300">
        Explore Food Service
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </a>
</div>
@endsection

</body>
</html>
