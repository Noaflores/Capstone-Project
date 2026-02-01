<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
        <!-- Header -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Update Order Progress</h1>

            <!-- Order Summary Section -->
            <div class="mb-6 border border-gray-300 rounded-lg p-4 bg-gray-50">
                <h2 class="text-lg font-semibold mb-3 text-center">Order Summary</h2>

                <!-- Display formatted order ID -->
                <p class="mb-2"><strong>Order ID:</strong> {{ $orderItem->formatted_order_id }}</p>

                <table class="w-full border-collapse mb-3">
                    <thead class="bg-gray-200 text-gray-700 text-sm">
                        <tr>
                            <th class="border px-2 py-1 text-left">Item Name</th>
                            <th class="border px-2 py-1 text-center">Quantity</th>
                            <th class="border px-2 py-1 text-center">Payment Method</th>
                            <th class="border px-2 py-1 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td class="border px-2 py-1">
                                {{ $item->item_name }}
                                {{-- Only show size if it is set and not empty --}}
                                @if(!empty($item->size))
                                    ({{ $item->size }})
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                            <td class="border px-2 py-1 text-center">{{ $item->payment_method }}</td>
                            <td class="border px-2 py-1 text-right">₱{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right font-semibold text-gray-800">
                    Total: ₱{{ number_format($total, 2) }}
                </div>
            </div>

            <!-- Status Edit Form -->
            <form method="POST" action="{{ route('staff.orders.updateStatus', $orderItem->order_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2"> Change Order Progress</label>

                    <select name="status"
    class="border rounded px-3 py-2 w-full"
    required>

    <option value="Pending" {{ $orderItem->status === 'Pending' ? 'selected' : '' }}>
        Pending
    </option>

    <option value="In Progress" {{ $orderItem->status === 'In Progress' ? 'selected' : '' }}>
        In Progress
    </option>

    <option value="Completed" {{ $orderItem->status === 'Completed' ? 'selected' : '' }}>
        Completed
    </option>
</select>
<p class="text-sm text-gray-500 mb-2">
    This refers to food preparation, not payment status.
</p>

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
