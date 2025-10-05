<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Header -->
        <div class="bg-[#A0C878] p-6 flex justify-between items-center shadow-md">
            <h1 class="text-2xl font-bold text-gray-800 mx-auto">Order Menu Page</h1>
            
            <!-- Edit Status button (aligned right) -->
            <div class="absolute right-8">
                <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">
                    Edit Status
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            @if($orders->isEmpty())
                <div class="text-center mt-10">
                    <span class="bg-[#A0C878] text-black font-bold px-6 py-3 rounded-lg">
                        No Orders Found
                    </span>
                </div>
            @else
                <table class="w-full border-collapse bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">Item ID</th>
                            <th class="px-6 py-3 text-left">Order ID</th>
                            <th class="px-6 py-3 text-left">Item Name</th>
                            <th class="px-6 py-3 text-left">Quantity</th>
                            <th class="px-6 py-3 text-left">Subtotal</th>
                            <th class="px-6 py-3 text-left">Order Date</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $order->id }}</td>
                                <td class="px-6 py-3">{{ $order->order->id ?? '' }}</td>
                                <td class="px-6 py-3">{{ $order->item_name }}</td>
                                <td class="px-6 py-3">{{ $order->quantity }}</td>
                                <td class="px-6 py-3">₱{{ number_format($order->subtotal, 2) }}</td>
                                <td class="px-6 py-3">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-3">...</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
