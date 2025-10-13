<x-app-layout>
    @section('title', 'Create Menu')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Create Menu Item</h1>

                <form id="menuForm" 
                      method="POST" 
                      action="{{ route('menu.store') }}" 
                      enctype="multipart/form-data" 
                      x-data="{ showModal: false, imagePreview: null }" 
                      @submit.prevent="showModal = true" 
                      x-ref="menuForm">
                    @csrf

                    <!-- Back + Action buttons -->
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('menu.edit') }}" 
                           class="inline-block bg-gray-500 text-white px-4 py-2 rounded-full font-bold hover:bg-gray-600">
                            ← Back to Menu List
                        </a>

                        <div class="flex gap-4">
                            <button type="reset" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700"
                                    @click="imagePreview = null">
                                Reset
                            </button>

                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700">
                                Create
                            </button>
                        </div>
                    </div>

                    <!-- Grid Layout: Left (details) | Right (image) -->
                    <div class="grid grid-cols-2 gap-6 items-start">
                        <!-- Left: Item details -->
                        <div>
                            <!-- Item Name -->
                            <div class="mb-4">
                                <label for="name" class="block font-bold mb-2">Item Name</label>
                                <input type="text" name="name" id="name" 
                                       class="w-full border p-2 rounded-md bg-gray-100">
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block font-bold mb-2">Description</label>
                                <textarea name="description" id="description" rows="5"
                                          class="w-full border p-2 rounded-md bg-gray-100"></textarea>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block font-bold mb-2">Price</label>
                                <input type="number" step="0.01" name="price" id="price"
                                       class="w-full border p-2 rounded-md bg-gray-100">
                            </div>
                        </div>

                        <!-- Right: Image upload -->
<div class="flex flex-col items-center">
    <label for="image" class="block font-bold mb-2 self-start">Item Image</label>

    <input 
        type="file" 
        name="image" 
        id="image" 
        accept="image/*"
        class="border p-2 w-full rounded-md bg-gray-100 mb-4"
        @change="
            const file = $event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => imagePreview = e.target.result;
                reader.readAsDataURL(file);
            } else {
                imagePreview = null;
            }
        "
    >

    <!-- Live Preview -->
    <template x-if="imagePreview">
        <div class="mt-4">
            <img :src="imagePreview" alt="Image Preview" 
                 class="w-48 h-48 object-cover rounded-lg border shadow-md">
        </div>
    </template>

    <!-- Upload Hint (hidden when preview is shown) -->
    <p class="text-sm text-gray-500 mt-3" x-show="!imagePreview" x-transition>
        Upload an image for this item.
    </p>
</div>


                    <!-- Confirmation Modal -->
                    <div x-show="showModal" 
                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
                        <div class="bg-white p-12 rounded-2xl shadow-2xl w-[800px] max-w-[95%] text-center border border-gray-300">
                            <h2 class="text-3xl font-bold text-gray-800 mb-12">
                                Do you wish to save your changes?
                            </h2>

                            <div class="grid grid-cols-2 gap-32">
                                <button type="button" 
                                        @click="showModal = false"
                                        class="w-full py-5 rounded-lg font-bold text-xl text-white bg-red-600 hover:bg-red-700 shadow-lg transition">
                                    No
                                </button>

                                <button type="button" 
                                        @click="$refs.menuForm.submit()"
                                        class="w-full py-5 rounded-lg font-bold text-xl text-white bg-green-600 hover:bg-green-700 shadow-lg transition">
                                    Yes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
