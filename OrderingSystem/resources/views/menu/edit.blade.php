<x-app-layout>
    @section('title', 'Edit Menu Item')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">Edit Menu Item</h1>

                <!-- Back button -->
                <div class="mb-4">
                    <a href="{{ route('menu.manage') }}"
                       class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        ← Back to Menu List
                    </a>
                </div>

                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Display success message -->
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Edit form -->
                <form action="{{ route('menu.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block font-medium">Name</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $item->name) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="sub_category_id" class="block font-medium">Sub Category ID</label>
                        <input type="number" id="sub_category_id" name="sub_category_id"
                               min="1000" max="9999"
                               value="{{ old('sub_category_id', $item->sub_category_id) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm"
                               placeholder="Enter 4-digit sub-category ID">
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block font-medium">Price</label>
                        <input type="number" id="price" name="price" step="0.01"
                               value="{{ old('price', $item->price) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium">Description</label>
                        <textarea id="description" name="description"
                                  class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="item_type" class="block font-medium">Type</label>
                        <select id="item_type" name="item_type"
                                class="w-full border-gray-300 rounded-lg shadow-sm px-4 py-2">
                            <option value="Drink" {{ old('item_type', $item->item_type) == 'Drink' ? 'selected' : '' }}>Drink</option>
                            <option value="Food" {{ old('item_type', $item->item_type) == 'Food' ? 'selected' : '' }}>Food</option>
                            <option value="Dessert" {{ old('item_type', $item->item_type) == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                        </select>
                    </div>

                    <!-- Current image + upload -->
                    <div class="mb-6">
                        <label class="block font-medium mb-2">Current Image</label>

                        @if($item->image_path)
                            <img id="currentImage"
                                 src="{{ asset('storage/' . $item->image_path) }}"
                                 alt="Current image for {{ $item->name }}"
                                 class="w-48 h-48 object-cover rounded-lg border mb-4">
                        @else
                            <p class="text-gray-500 italic mb-4">No image uploaded.</p>
                        @endif

                        <label for="image" class="block font-medium">Change Image</label>
                        <input type="file" id="image" name="image"
                               accept="image/*"
                               class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                               onchange="previewNewImage(event)">

                        <div id="previewContainer" class="mt-4 hidden">
                            <p class="text-gray-700 font-medium mb-2">Preview:</p>
                            <img id="previewImage" src="#" alt="New image preview"
                                 class="w-48 h-48 object-cover rounded-lg border">
                        </div>

                        <p id="keepText" class="text-sm text-gray-500 mt-2">
                            Leave empty to keep the current image.
                        </p>
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewNewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');
            const currentImage = document.getElementById('currentImage');
            const keepText = document.getElementById('keepText');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    if (currentImage) currentImage.classList.add('opacity-50');
                    if (keepText) keepText.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
                if (currentImage) currentImage.classList.remove('opacity-50');
                if (keepText) keepText.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
