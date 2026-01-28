<x-app-layout>
    @section('title', 'Sales Report')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monthly Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- PAGE TITLE --}}
                <h1 class="text-2xl font-semibold mb-6">Monthly Sales Report</h1>

                {{-- FILTER + PDF + SALES SEARCH --}}
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <form method="GET" action="{{ route('sales.report') }}" class="flex items-center gap-3">
                            <label for="month" class="font-semibold">Select Month:</label>
                            <select
                                name="month"
                                id="month"
                                class="border rounded px-3 py-2"
                                style="width: 220px;"
                                onchange="this.form.submit()"
                            >
                                <option value=""> Select Month </option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </form>

                        @if($selectedMonth && $sales->count() > 0)
                            <a href="{{ route('reports.sales.pdf', request()->query()) }}"
                               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                               Download PDF
                            </a>
                        @endif
                    </div>

                    {{-- SALES SEARCH --}}
                    <div class="flex items-center gap-2">
                        <form method="GET" action="{{ route('sales.report') }}" class="flex items-center gap-2">
                            <input type="text" name="search_sales"
                                   value="{{ request('search_sales') }}"
                                   placeholder="Search sales..."
                                   class="border rounded px-3 py-2 w-64">
                            <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Search
                            </button>
                            @if(request('month'))
                                <input type="hidden" name="month" value="{{ request('month') }}">
                            @endif
                        </form>
                    </div>
                </div>

                {{-- SALES TABLE --}}
<table class="w-full border-collapse border border-gray-300 mb-4">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">Item ID</th>
            <th class="border px-4 py-2">Item Name</th>
            <th class="border px-4 py-2">User ID</th>
            <th class="border px-4 py-2">Price</th>
            <th class="border px-4 py-2">Date and Time</th>
            <th class="border px-4 py-2">Amount Sold</th>
            <th class="border px-4 py-2">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @if($selectedMonth && $sales->count() > 0)
            @foreach ($sales as $sale)
    <tr class="hover:bg-gray-50">
        <td class="border px-4 py-2">{{ $sale->item_id }}</td>
        <td class="border px-4 py-2">
            {{ $sale->item_name }}
            @if(!empty($sale->size))
                ({{ $sale->size }})
            @endif
        </td>
        <td class="border px-4 py-2">{{ $sale->user_id }}</td>
        <td class="border px-4 py-2">₱{{ number_format($sale->price, 2) }}</td>
        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d H:i:s') }}</td>
        <td class="border px-4 py-2">{{ $sale->amount_sold }}</td>
        <td class="border px-4 py-2">₱{{ number_format($sale->subtotal, 2) }}</td>
    </tr>
@endforeach

            {{-- TOTAL ROW --}}
            <tr class="font-bold bg-gray-100">
                <td colspan="6" class="text-right px-4 py-2">Total Sales:</td>
                <td class="px-4 py-2">₱{{ number_format($totalSales, 2) }}</td>
            </tr>
        @else
            <tr>
                <td colspan="7" class="text-center py-4 text-gray-500">
                   This sales table is empty.
                </td>
            </tr>
        @endif
    </tbody>
</table>

{{-- PAGINATION LINKS --}}
@if($selectedMonth && $sales->count() > 0)
    <div class="mt-4">
        {{ $sales->links() }}
    </div>
@endif

                {{-- CUSTOMERS TABLE --}}
                <div class="bg-white shadow-md rounded-lg p-8 mt-10">
                    <h2 class="text-2xl font-bold mb-4">Customers Table</h2>

                    {{-- CUSTOMER SEARCH --}}
                    <form method="GET" action="{{ route('sales.report') }}" class="flex items-center gap-2 mb-6">
                        <input type="text" name="search_customers"
                               value="{{ request('search_customers') }}"
                               placeholder="Search customers..."
                               class="border rounded px-3 py-2 w-64">
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Search
                        </button>
                    </form>

                    <table class="w-full border-collapse border border-gray-300 table-fixed">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 w-[350px] text-left">Email</th>
                                <th class="border px-4 py-2 w-[180px] text-left">Contact Number</th>
                                <th class="border px-4 py-2 w-[160px] text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2 truncate" title="{{ $customer->Email }}">
                                        {{ $customer->Email }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ substr($customer->contact_number ?? 'N/A', 0, 4)
                                           . str_repeat('*', max(strlen($customer->contact_number ?? '') - 4, 0)) }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <form action="{{ route('users.destroy', $customer->customer_id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to remove this customer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">No Customers Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
