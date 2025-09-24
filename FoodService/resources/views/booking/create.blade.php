<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book Experience</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-tr from-indigo-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center p-6">

@extends('layouts.app')

@section('content')
  <div class="bg-white max-w-md w-full rounded-3xl shadow-lg p-8 space-y-6">
    <h1 class="text-3xl font-extrabold text-indigo-700 text-center mb-4">Book Your Experience</h1>

    <form action="{{ route('booking.submit') }}" method="POST" class="space-y-5">
      @csrf
      <input type="hidden" name="experience_id" value="{{ request()->id }}" />

      <div>
        <label for="customer_name" class="block text-indigo-600 font-semibold mb-2">Your Name</label>
        <input
          type="text"
          name="customer_name"
          id="customer_name"
          required
          placeholder="Enter your full name"
          class="w-full rounded-lg border border-indigo-300 p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
        />
      </div>

      <div>
        <label for="scheduled_at" class="block text-indigo-600 font-semibold mb-2">Schedule Date & Time</label>
        <input
          type="datetime-local"
          name="scheduled_at"
          id="scheduled_at"
          required
          class="w-full rounded-lg border border-indigo-300 p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
        />
      </div>

      <button
        type="submit"
        class="w-full bg-indigo-600 text-white font-bold rounded-full py-3 hover:bg-indigo-700 shadow-md transition"
      >
        Submit Booking
      </button>
    </form>
  </div>
@endsection

</body>
</html>
