<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chef's Section Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-rose-50 via-orange-50 to-amber-100 min-h-screen font-sans">

@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl md:text-5xl font-extrabold text-center text-red-600 mb-10 drop-shadow">👨‍🍳 Meet Our Chefs</h1>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 justify-items-center">
      @foreach($chefs as $chef)
        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition transform hover:-translate-y-2 w-full max-w-xs text-center p-6">
          <img src="{{ asset('images/' . $chef->image) }}" alt="{{ $chef->name }}"
               class="w-32 h-32 mx-auto rounded-full object-cover border-4 border-white shadow mb-4">
          
          <h2 class="text-xl font-semibold text-gray-800">{{ $chef->name }}</h2>
          
          <a href="{{ route('chefs.show', $chef->id) }}"
             class="mt-4 inline-block px-5 py-2 rounded-full bg-red-500 text-white font-medium hover:bg-red-600 transition">
            View Profile
          </a>
        </div>
      @endforeach
    </div>
  </div>
@endsection

</body>
</html>
