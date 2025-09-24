<html lang="en" class="bg-gradient-to-tr from-purple-50 via-pink-50 to-yellow-50 min-h-screen flex items-center justify-center p-6">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Confirm Your Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="max-w-lg w-full bg-white rounded-3xl shadow-lg p-8 space-y-8">

  <h2 class="text-3xl font-extrabold text-purple-700 text-center">Confirm Your Booking</h2>

 
  <section class="bg-purple-50 border border-purple-200 rounded-xl p-6 space-y-3">
    <h3 class="font-semibold text-purple-900 text-lg mb-4 border-b border-purple-300 pb-2">Booking Summary</h3>
    <p><strong>Name:</strong> <span class="text-gray-700">{{ $bookingData['customer_name'] ?? 'N/A' }}</span></p>
    <p><strong>Email:</strong> <span class="text-gray-700">{{ $bookingData['email'] ?? 'N/A' }}</span></p>
    <p><strong>Date:</strong> <span class="text-gray-700">{{ $bookingData['date'] ?? 'N/A' }}</span></p>
    <p><strong>Time Slot:</strong> <span class="text-gray-700">{{ $bookingData['time_slot'] ?? 'N/A' }}</span></p>
    <p><strong>Experience:</strong> <span class="text-gray-700">{{ $bookingData['experience_title'] ?? 'N/A' }}</span></p>
    <p><strong>Price:</strong> <span class="text-green-600 font-semibold">₱{{ number_format($bookingData['amount'] ?? 0, 2) }}</span></p>
  </section>


  <form id="paymentForm" method="POST" action="{{ route('payment.process') }}" class="space-y-6">
    @csrf

    <input type="hidden" name="booking_id" value="{{ $bookingData['booking_id'] ?? '' }}">
    <input type="hidden" name="amount" value="{{ $bookingData['amount'] ?? '' }}">

    <div>
      <label for="payment_method" class="block mb-2 font-semibold text-gray-700">Payment Method:</label>
      <select
        id="payment_method"
        name="payment_method"
        required
        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-400 transition"
      >
        <option value="" disabled selected>Select a method</option>
        <option value="paypal">PayPal</option>
        <option value="stripe">Stripe</option>
      </select>
    </div>

    <div class="flex gap-4">
      <button
        type="submit"
        class="flex-1 bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 shadow-lg transition"
      >
        Purchase
      </button>
      <a
        href="{{ route('home') }}"
        class="flex-1 text-center border border-red-500 text-red-600 font-semibold py-3 rounded-lg hover:bg-red-50 transition"
      >
        Cancel Purchase
      </a>
    </div>
  </form>

</div>

@if (session('success'))

<div
  id="successModal"
  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
  style="display:none"
>
  <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 space-y-4">
    <h3 class="text-xl font-bold text-green-700">Booking Confirmed!</h3>
    <p>{{ session('success') }}</p>
    <div class="text-right">
      <a
        href="{{ route('tours') }}"
        class="inline-block bg-purple-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-purple-700 transition"
      >
        OK
      </a>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('successModal');
    modal.style.display = 'flex';
    
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.style.display = 'none';
    });
  });
</script>
@endif

@endsection

</body>
</html>
