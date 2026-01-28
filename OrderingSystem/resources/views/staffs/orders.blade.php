<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Header -->
       <div class="bg-[#A0C878] p-6 pl-10 flex items-center shadow-md">
    <h1 class="text-2xl font-bold text-gray-800">Order Menu Page</h1>
</div>
        <!-- Success Message -->
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
                            <th class="px-6 py-3 text-left">Order ID</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Order Date</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center w-38">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $order->formatted_order_id }}</td>
                                <td class="px-6 py-3">₱{{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                <td class="px-6 py-3">{{ $order->status }}</td>

                                <td class="px-6 py-3 text-center">
    <div class="inline-flex items-center justify-center gap-3">
        <!--  Edit Button -->
        <a href="{{ route('staff.orders.editStatus', ['id' => $order->order_id]) }}"
           class="bg-green-700 hover:bg-green-800 text-white px-3 py-1.5 rounded-md text-sm font-medium shadow-sm transition">
            Edit
        </a>

        <!--  Finish Button -->
<form action="{{ route('staff.orders.finish', $order->order_id) }}" method="POST">
    @csrf
    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">
        Done
    </button>
</form>
    </div>
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
