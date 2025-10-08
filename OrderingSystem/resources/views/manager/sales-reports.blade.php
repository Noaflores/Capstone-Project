<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monthly Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- FIX 1: Added a title inside the container for better placement --}}
                <h1 class="text-2xl font-semibold mb-4">Monthly Sales Report</h1>

                <form method="GET" action="{{ route('reports.sales') }}" class="mb-4 flex items-center space-x-3">
                    <label for="month" class="font-semibold">Select Month: </label>

                    <select name="month" id="month"
                        class="border rounded p-2 bg-gray-50 focus:ring-2 focus:ring-blue-400"
                        style="width: 150px;">

                        {{-- FIX 2: Modified the default option to correctly show/hide when a month is selected --}}
                        <option value="" disabled {{ $selectedMonth ? '' : 'selected' }} hidden>Select Month</option>

                        @foreach ($months as $num => $monthName)
                            {{-- FIX 3: Corrected the comparison to properly select the chosen month --}}
                            <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="ml-3 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-400">
                        Select
                    </button>
                </form>

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
                        {{-- This @forelse loop is already correct for handling an empty table --}}
                        @forelse ($sales as $sale)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->item_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->item_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $sale->amount_sold }}</td>
                                <td class="border border-gray-300 px-4 py-2">₱{{ number_format($sale->subtotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No Report Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4 font-bold text-right">
                    Total Sales: ₱{{ number_format($totalSales ?? 0, 2) }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>