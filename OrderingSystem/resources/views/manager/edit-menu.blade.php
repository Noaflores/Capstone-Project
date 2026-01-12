<x-app-layout>
    @section('title', 'Edit-menu')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Edit Menu Items</h1>

                <!-- ✅ Only Create item button on top -->
                <div class="mode-buttons mb-6">
                    <a href="{{ route('menu.create') }}" class="action-button">Create item</a>
                </div>

                <!-- ✅ Table of menu items -->
                <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border text-left">ID</th>
                            <th class="px-4 py-2 border text-left">Name</th>
                            <th class="px-4 py-2 border text-left">Sub Category ID</th>
                            <th class="px-4 py-2 border text-left">Price</th>
                            <th class="px-4 py-2 border text-left">Description</th>
                            <th class="px-4 py-2 border text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menuItems as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $item->id }}</td>
                                <td class="px-4 py-2 border">{{ $item->name }}</td>
                                <td class="px-4 py-2 border">{{ $item->sub_category_id }}</td>
                                <td class="px-4 py-2 border">{{ number_format($item->price, 2) }}</td>
                                <td class="px-4 py-2 border">{{ $item->description }}</td>
                                <td class="px-4 py-2 border">
        <div class="flex justify-center items-center gap-2">
        <!-- Edit button -->
        <a href="{{ route('menu.editItem', $item->id) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Edit
        </a>

        <!-- Remove button -->
        @if ($item->order_count == 0)
            <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:red;color:white;padding:6px 12px;border-radius:6px;">
                    Remove
                </button>
            </form>
        @else
            <span class="text-gray-400 italic">Locked</span>
        @endif
    </div>
</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">No menu items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <style>
                    .mode-buttons {
                        display: flex;
                        justify-content: flex-start;
                        gap: 20px;
                    }

                    .action-button {
                        min-width: 150px;
                        padding: 10px 20px;
                        font-size: 16px;
                        border: 2px solid #16a34a;
                        border-radius: 8px;
                        background-color: #f9fafb;
                        color: #16a34a;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.2s;
                        text-align: center;
                        display: inline-block;
                    }

                    .action-button:hover {
                        background-color: #16a34a;
                        color: white;
                    }
                </style>
            </div>
        </div>
    </div>
</x-app-layout>
