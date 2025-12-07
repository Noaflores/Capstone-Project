<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
        <!-- Header -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Order Status</h1>
            <!-- Order Summary Section -->
            <div class="mb-6 border border-gray-300 rounded-lg p-4 bg-gray-50">
                <h2 class="text-lg font-semibold mb-3 text-center">Order Summary</h2>

                <!-- Display custom formatted order ID -->
                <p class="mb-2"><strong>Order ID:</strong> {{ $orderItem->formatted_order_id }}</p>

                <table class="w-full border-collapse mb-3">
                    <thead class="bg-gray-200 text-gray-700 text-sm">
                        <tr>
                            <th class="border px-2 py-1 text-left">Item Name</th>
                            <th class="border px-2 py-1 text-center">Qty</th>
                            <th class="border px-2 py-1 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                            <tr>
                                <td class="border px-2 py-1">{{ $item->item_name }}</td>
                                <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                <td class="border px-2 py-1 text-right">₱{{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right font-semibold text-gray-800">
                    Total: ₱{{ number_format($total, 2) }}
                </div>
            </div>

            <!-- 🔧 Status Edit Form -->
<form method="POST" action="{{ route('staff.orders.updateStatus', $orderItem->order_id) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
        <select name="status" id="status"
                class="w-full border-gray-300 rounded-lg px-3 py-2">
            <option value="Pending" {{ $orderItem->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ $orderItem->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Completed" {{ $orderItem->status == 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('staff.orders') }}" 
           class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Cancel
        </a>
        <button type="submit" 
                class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">
            Update
        </button>
    </div>
</form>

        </div>
    </div>
</x-app-layout>
