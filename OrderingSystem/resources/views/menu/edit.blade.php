<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                
                <h1 class="text-2xl font-bold mb-6">Edit Menu Item</h1>

                <!-- ✅ Back button -->
                <div class="mb-4">
                    <a href="{{ route('menu.edit') }}" 
                       class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        ← Back to Menu List
                    </a>
                </div>

                <!-- ✅ Edit form -->
                <form action="{{ route('menu.update', $item->item_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block font-medium">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block font-medium">Price</label>
                        <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $item->price) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium">Description</label>
                        <textarea id="description" name="description"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save Changes
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
