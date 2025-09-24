<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book {{ $topic }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-yellow-50 via-red-50 to-pink-50 min-h-screen flex items-center justify-center">

<div class="bg-white max-w-md w-full rounded-3xl shadow-xl p-8 mx-4">
  <h2 class="text-3xl font-extrabold text-red-600 mb-4">Booking: <span class="capitalize">{{ $topic }}</span></h2>

  <p class="text-gray-700 mb-1"><span class="font-semibold">Chef:</span> {{ $chef }}</p>
  <p class="text-gray-700 mb-6"><span class="font-semibold">Price:</span> ₱{{ $price }}</p>

  <form action="{{ route('payment.process') }}" method="POST" class="space-y-6">
    @csrf
    <input type="hidden" name="topic" value="{{ $topic }}">
    <input type="hidden" name="price" value="{{ $price }}">

    <div>
      <label for="date" class="block mb-2 font-semibold text-red-600">Preferred Date</label>
      <input
        type="date"
        name="date"
        id="date"
        required
        class="w-full rounded-lg border border-red-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400 transition"
      />
    </div>

    <div>
      <label for="time" class="block mb-2 font-semibold text-red-600">Preferred Time</label>
      <select
        name="time"
        id="time"
        required
        class="w-full rounded-lg border border-red-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400 transition"
      >
        <option value="12:00 PM - 3:00 PM">12:00 PM - 3:00 PM</option>
        <option value="4:00 PM - 7:00 PM">4:00 PM - 7:00 PM</option>
      </select>
    </div>

    <div class="flex space-x-4">
      <button
        type="submit"
        class="flex-1 bg-red-600 text-white font-semibold rounded-full py-3 hover:bg-red-700 shadow-lg transition"
      >
        Proceed to Payment
      </button>
      <a
        href="{{ route('tours') }}"
        class="flex-1 text-center bg-gray-200 text-gray-700 font-semibold rounded-full py-3 hover:bg-gray-300 transition"
      >
        Cancel
      </a>
    </div>
  </form>
</div>

</body>
</html>
