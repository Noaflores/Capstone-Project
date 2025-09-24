<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chef's Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-rose-50 via-orange-100 to-pink-50 min-h-screen font-sans text-gray-800">

@extends('layouts.app')

@section('content')
  <div class="relative container mx-auto px-6 py-12 text-center">

    
    <a href="{{ route('chefs.index') }}" 
       class="absolute top-6 right-6 text-red-600 hover:text-red-800 font-medium text-sm border border-red-400 px-4 py-1.5 rounded-full transition">
       ← Back to Chef Section
    </a>

   
    <img src="{{ asset('images/' . $chef->image) }}" 
         alt="{{ $chef->name }}"
         class="w-48 h-48 object-cover rounded-full border-8 border-white shadow-xl mx-auto mb-6">

    
    <h1 class="text-4xl md:text-5xl font-extrabold text-red-600 mb-2">{{ $chef->name }}</h1>

    
    <div class="mt-6 space-y-3 text-lg md:text-xl">
      <p><span class="font-semibold text-red-500">Specialty:</span> {{ $chef->specialty }}</p>
      <p><span class="font-semibold text-red-500">Chef Title:</span> {{ $chef->chef_title }}</p>
      <p><span class="font-semibold text-red-500">Favorite Dish:</span> {{ $chef->favorite_dish }}</p>
      <p><span class="font-semibold text-red-500">Teaching Years:</span> {{ $chef->teaching_years }}</p>
      <p class="italic text-gray-600 mt-4">“{{ $chef->quote }}”</p>
    </div>

  </div>
@endsection

</body>
</html>
