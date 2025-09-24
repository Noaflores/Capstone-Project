<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chefs Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-orange-50 via-rose-100 to-red-100 min-h-screen font-sans text-gray-800">

@extends('layouts.app')

@section('content')
 
  <div class="text-center py-12">
    <h1 class="text-5xl font-extrabold text-red-600 mb-3 drop-shadow">👨‍🍳 Meet Our Chefs</h1>
    <p class="text-gray-600 max-w-2xl mx-auto text-lg">
      Meet the passionate culinary minds crafting unforgettable flavors and experiences. Their dedication is the secret ingredient to everything we serve.
    </p>
  </div>


  <div class="flex flex-wrap justify-center gap-8 px-4 mb-10">
    <div class="hover:scale-105 transition-transform">
      <img src="{{ asset('images/chefs/noah.jpg') }}" alt="Noah" class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
      <p class="text-center mt-2 font-medium">Noah</p>
    </div>
    <div class="hover:scale-105 transition-transform">
      <img src="{{ asset('images/chefs/robbie.jpg') }}" alt="Robbie" class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
      <p class="text-center mt-2 font-medium">Robbie</p>
    </div>
    <div class="hover:scale-105 transition-transform">
      <img src="{{ asset('images/chefs/marco.jpg') }}" alt="Marco" class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
      <p class="text-center mt-2 font-medium">Marco</p>
    </div>
    <div class="hover:scale-105 transition-transform">
      <img src="{{ asset('images/chefs/irish.jpg') }}" alt="Irish" class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
      <p class="text-center mt-2 font-medium">Irish</p>
    </div>
  </div>


  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 pb-16">
    @foreach ($chefs as $chef)
      <div class="bg-white p-6 rounded-3xl shadow-lg hover:shadow-2xl transition duration-300 relative">
        <div class="absolute -top-6 -left-6 w-12 h-12 bg-red-500 text-white rounded-full flex items-center justify-center shadow-md">
          🍴
        </div>
        <h
