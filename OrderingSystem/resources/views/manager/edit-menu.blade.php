<x-app-layout>
    @section('title', 'Edit Menu')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu Items') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- PAGE TITLE --}}
                <h1 class="text-2xl font-semibold mb-6">Edit Menu Items</h1>

                {{-- FILTER + SEARCH --}}
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    {{-- CATEGORY FILTER --}}
                    <form method="GET" action="{{ route('menu.manage') }}" class="flex items-center gap-3">
                        <label for="type" class="font-semibold">Select Category:</label>
                        <select name="type"
                                id="type"
                                class="border rounded px-3 py-2 w-64"
                                onchange="this.form.submit()"
                        >
                            <option value="">All Categories</option>
                            <option value="Appetizers" {{ request('type') == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                            <option value="Main Courses" {{ request('type') == 'Main Courses' ? 'selected' : '' }}>Main Courses</option>
                            <option value="Desserts" {{ request('type') == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                            <option value="Snacks" {{ request('type') == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                            <option value="Side Dishes" {{ request('type') == 'Side Dishes' ? 'selected' : '' }}>Side Dishes</option>
                            <option value="Beverages" {{ request('type') == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                        </select>
                    </form>

                    {{-- SEARCH --}}
                    <form method="GET" action="{{ route('menu.manage') }}" class="flex items-center gap-2">
                        <input type="text" name="search"
                               value="{{ request('search') }}"
                               placeholder="Search menu items..."
                               class="border rounded px-3 py-2 w-64">

                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Search
                        </button>
                    </form>
                </div>

                {{-- MENU TABLE --}}
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">Item ID</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Category</th>
                            <th class="border px-4 py-2">Price</th>
                            <th class="border px-4 py-2">Description</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menuItems as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $item->sub_category_id }}</td>
                                <td class="border px-4 py-2">{{ $item->name }}</td>
                                <td class="border px-4 py-2">{{ $item->item_type }}</td>
                                <td class="border px-4 py-2">₱{{ number_format($item->price, 2) }}</td>
                                <td class="border px-4 py-2 truncate" title="{{ $item->description }}">
                                    {{ $item->description }}
                                </td>
                                <td class="border px-4 py-2 text-center">
    <div class="flex justify-center space-x-2">
        <a href="{{ route('menu.editItem', $item->id) }}"
           class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
           Edit
        </a>
        <form action="{{ route('menu.destroy', $item->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                Delete
            </button>
        </form>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No Menu Items Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                <div class="mt-4">
                    {{ $menuItems->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
