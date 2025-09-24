<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Review Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-purple-50 to-pink-100 min-h-screen font-sans text-gray-800">

@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10">

  <h2 class="text-3xl font-extrabold text-center text-purple-700 mb-8">User Reviews</h2>

  @if(session('success'))
    <div class="mb-6 p-4 text-green-800 bg-green-100 rounded-lg shadow-md">
      {{ session('success') }}
    </div>
  @endif


  <form action="{{ route('reviews.store') }}" method="POST" class="mb-10 bg-white p-6 rounded-2xl shadow-md border border-purple-200">
    @csrf

    <label for="name" class="block mb-2 font-semibold text-purple-700">Your Name:</label>
    <input type="text" name="name" required
           class="w-full mb-5 px-4 py-3 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-400 transition" />

    <label for="comment" class="block mb-2 font-semibold text-purple-700">Your Review:</label>
    <textarea name="comment" rows="4" required
              class="w-full mb-5 px-4 py-3 rounded-lg border border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-400 transition resize-none"></textarea>

    <button type="submit"
            class="w-full bg-purple-600 text-white font-bold py-3 rounded-full hover:bg-purple-700 transition shadow-lg">
      Submit Review
    </button>
  </form>

 
  <div class="space-y-6">
    @forelse($reviews as $review)
      <div class="bg-white p-5 rounded-xl shadow-lg border border-purple-200 hover:shadow-xl transition">
        <h5 class="text-xl font-semibold text-purple-700">{{ $review->name }}</h5>
        <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $review->comment }}</p>
        <p class="mt-3 text-sm text-gray-400 italic">{{ $review->created_at->diffForHumans() }}</p>
      </div>
    @empty
      <p class="text-center text-gray-500 italic">No reviews yet. Be the first!</p>
    @endforelse
  </div>

</div>
@endsection

</body>
</html>
