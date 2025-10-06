<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Header -->
<div class="bg-[#A0C878] p-6 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mx-auto">Order Menu Page</h1>
</div>

<!-- ✅ Success Message -->
@if (session('success'))
    <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        {{ session('success') }}
    </div>
@endif


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
                            <th class="px-6 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $orderItem)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $orderItem->formatted_item_id }}</td>
                                <td class="px-6 py-3">{{ $orderItem->formatted_order_id }}</td>
                                <td class="px-6 py-3">{{ $orderItem->item_name }}</td>
                                <td class="px-6 py-3">{{ $orderItem->quantity }}</td>
                                <td class="px-6 py-3">₱{{ number_format($orderItem->subtotal, 2) }}</td>
                                <td class="px-6 py-3">{{ $orderItem->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-3">{{ $orderItem->status }}</td>
                                <td class="px-6 py-3">
                                    @if($orderItem->order)
                                        <a href="{{ route('staff.orders.editStatus', $orderItem->id) }}" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded">
                                        Edit Status
                                        </a>
                                    @else
                                        <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" disabled>
                                            No Order Linked
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
