<x-app-layout>
    @section('title', 'Create Menu')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" 
                 x-data="menuForm()">

                <h1 class="text-2xl font-bold mb-6">Create Menu Item</h1>

                <form id="menuForm" 
                      method="POST" 
                      action="{{ route('menu.store') }}" 
                      enctype="multipart/form-data"
                      x-ref="menuForm">
                    @csrf

                    <!-- Back + Action buttons -->
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('menu.manage') }}"
                           class="inline-block bg-gray-500 text-white px-4 py-2 rounded-full font-bold hover:bg-gray-600">
                            ← Back to Menu List
                        </a>

                        <div class="flex gap-4">
                            <button type="reset" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700"
                                    @click="resetForm()">
                                Reset
                            </button>

                            <button type="button" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700"
                                    @click="showModal = true"
                                    :disabled="duplicate">
                                Create
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 items-start">

                        <!-- Left: Details -->
                        <div>
                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="block font-bold mb-2">Item Name</label>
                                <input type="text" name="name" id="name" 
                                       class="w-full border p-2 rounded-md bg-gray-100" required>
                            </div>

                            <!-- Sub Category ID -->
                            <div class="mb-4">
                                <label for="sub_category_id" class="block font-bold mb-2">Sub Category ID</label>
                                <input type="number"
                                       id="sub_category_id"
                                       name="sub_category_id"
                                       x-model="subId"
                                       min="1000" max="9999"
                                       class="w-full border p-2 rounded-md bg-gray-100"
                                       placeholder="Enter 4-digit number"
                                       required
                                       @input="checkDuplicate()">

                                <p class="text-sm text-gray-500 mt-1">
                                    Example 4-digit IDs: 1742=Hot Beverages, 4217=Cold Beverages, 5023=Coffee, 8931=Tea
                                </p>

                                <p class="text-sm text-red-600 mt-1" x-show="duplicate" x-transition>
                                    ⚠️ This Sub Category ID already exists!
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="block font-bold mb-2">Description</label>
                                <textarea name="description" id="description" rows="5"
                                          class="w-full border p-2 rounded-md bg-gray-100" required></textarea>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="block font-bold mb-2">Price</label>
                                <input type="number" step="0.01" name="price" id="price"
                                       class="w-full border p-2 rounded-md bg-gray-100" required>
                            </div>

                            <!-- Item Type -->
                            <div class="mb-4">
                                <label for="item_type" class="block font-bold mb-2">Item Type</label>
                                <select name="item_type" id="item_type" class="w-full border p-2 rounded-md bg-gray-100" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="Drink">Drink</option>
                                    <option value="Food">Food</option>
                                    <option value="Dessert">Dessert</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right: Image -->
                        <div class="flex flex-col items-center">
                            <label for="image" class="block font-bold mb-2 self-start">Item Image</label>

                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   accept="image/*"
                                   class="border p-2 w-full rounded-md bg-gray-100 mb-4"
                                   @change="previewImage($event)">

                            <template x-if="imagePreview">
                                <div class="mt-4">
                                    <img :src="imagePreview" alt="Image Preview" 
                                         class="w-48 h-48 object-cover rounded-lg border shadow-md">
                                </div>
                            </template>

                            <p class="text-sm text-gray-500 mt-3" x-show="!imagePreview" x-transition>
                                Upload an image for this item.
                            </p>
                        </div>
                    </div>

                    <!-- Confirmation Modal -->
                    <div x-show="showModal" 
                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
                        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[450px] max-w-[95%] text-center border border-gray-300">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                                Do you wish to save your changes?
                            </h2>

                            <div class="grid grid-cols-2 gap-6">
                                <button type="button" 
                                        @click="showModal = false"
                                        class="w-full py-3 rounded-lg font-bold text-white bg-red-600 hover:bg-red-700 shadow-lg transition">
                                    No
                                </button>

                                <button type="button" 
                                        @click="$refs.menuForm.submit()"
                                        class="w-full py-3 rounded-lg font-bold text-white bg-green-600 hover:bg-green-700 shadow-lg transition"
                                        :disabled="duplicate">
                                    Yes
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function menuForm() {
            return {
                showModal: false,
                imagePreview: null,
                subId: '',
                duplicate: false,
                existingIds: @json($existingSubCategoryIds ?? []),

                previewImage(event) {
                    const file = event.target.files[0];
                    if(file) {
                        const reader = new FileReader();
                        reader.onload = e => this.imagePreview = e.target.result;
                        reader.readAsDataURL(file);
                    } else {
                        this.imagePreview = null;
                    }
                },

                checkDuplicate() {
                    const id = parseInt(this.subId);
                    this.duplicate = this.existingIds.includes(id);
                },

                resetForm() {
                    this.subId = '';
                    this.imagePreview = null;
                    this.duplicate = false;
                    this.$refs.menuForm.reset();
                }
            }
        }
    </script>

</x-app-layout>
