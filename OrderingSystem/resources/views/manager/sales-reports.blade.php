<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monthly Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Dropdown for Month Selection -->
                <form method="GET" action="{{ route('reports.sales') }}" class="mb-4 flex items-center space-x-3">
                    <label for="month" class="font-semibold">Select Month: </label>

                    <select name="month" id="month" 
                        class="border rounded p-2 bg-gray-50 focus:ring-2 focus:ring-blue-400"
                        style="width: 150px;">
                        
                        {{-- Default placeholder (not selectable in the list) --}}
                        <option value="" disabled selected hidden>Select Month</option>

                        @foreach ($months as $num => $monthName)
                            <option value="{{ $num }}" {{ $selectedMonth === $num ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" 
                        class="ml-3 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-400">
                        Select
                    </button>
                </form>

                <!-- Sales Table -->
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Item ID</th>
                            <th class="border border-gray-300 px-4 py-2">Item Name</th>
                            <th class="border border-gray-300 px-4 py-2">Amount Sold</th>
                            <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->item_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->item_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->amount_sold }}</td>
                                <td class="border border-gray-300 px-4 py-2">₱{{ number_format($sale->subtotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No sales found for this month.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Total Sales -->
                <div class="mt-4 font-bold text-right">
                    Total Sales: ₱{{ number_format($totalSales ?? 0, 2) }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
