<x-app-layout>
    @section('title', 'Edit Menu')

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-800"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    class="mb-4 px-4 py-3 rounded bg-red-100 border border-red-400 text-red-800"
                >
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- BACK TO HOME --}}
<a href="{{ route('homepage') }}"
   class="inline-flex items-center gap-2 mb-4
          px-4 py-2
          border border-gray-400
          rounded-md
          bg-gray-200
          text-sm font-medium text-gray-800
          hover:bg-gray-300 hover:border-gray-500
          transition">
    ← Return to Homepage
</a>


{{-- PAGE TITLE --}}
<h1 class="text-2xl font-semibold mb-4">Edit Menu Items</h1>


                {{-- CREATE BUTTON + CATEGORY FILTER + SEARCH --}}
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

                    {{-- LEFT SIDE: Create button + dropdown together --}}
                    <div class="flex items-center gap-1">
                        <a href="{{ route('menu.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Create Menu Item
                        </a>

                        <form method="GET" action="{{ route('menu.manage') }}">
                            <label for="type" class="sr-only">Select Category</label>
                            <select name="type"
                                    id="type"
                                    class="border rounded px-3 py-2 w-64"
                                    onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                <option value="Appetizer" {{ request('type') == 'Appetizer' ? 'selected' : '' }}>Appetizer</option>
                                <option value="Main Course" {{ request('type') == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                                <option value="Dessert" {{ request('type') == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                                <option value="Snack" {{ request('type') == 'Snack' ? 'selected' : '' }}>Snack</option>
                                <option value="Side Dish" {{ request('type') == 'Side Dish' ? 'selected' : '' }}>Side Dish</option>
                                <option value="Beverage" {{ request('type') == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                            </select>
                        </form>
                    </div>

                    {{-- RIGHT SIDE: SEARCH --}}
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
                                <td class="border px-4 py-2">{{ $item->category }}</td>
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

    {{-- Alpine.js for flash message --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
