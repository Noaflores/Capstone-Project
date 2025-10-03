<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Create Menu Item</h1>

                <form id="menuForm" method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data" x-data="{ showModal: false }" @submit.prevent="showModal = true" x-ref="menuForm">
                    @csrf

                    <!-- Back + Action buttons -->
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('menu.edit') }}" 
                           class="inline-block bg-gray-500 text-white px-4 py-2 rounded-full font-bold hover:bg-gray-600">
                            ← Back to Menu List
                        </a>

                        <div class="flex gap-4">
                            <button type="reset" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700">
                                Reset
                            </button>

                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-full font-bold hover:bg-green-700">
                                Create
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Left: Image upload -->
                        <div class="flex flex-col">
                            <label for="image" class="block font-bold mb-2">Item Image</label>
                            <input type="file" name="image" id="image" 
                                class="border p-2 w-full rounded-md">
                        </div>

                        <!-- Right: Item details -->
                        <div>
                            <!-- Item Name first -->
                            <div class="mb-4">
                                <label for="name" class="block font-bold">Item Name</label>
                                <input type="text" name="name" id="name" 
                                    class="w-full border p-2 rounded-md bg-gray-100">
                            </div>

                            <!-- Then Description -->
                            <div class="mb-4">
                                <label for="description" class="block font-bold">Description</label>
                                <textarea name="description" id="description" rows="3"
                                        class="w-full border p-2 rounded-md bg-gray-100"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Row: Item ID, Price -->
                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="item_id" class="block font-bold">Item ID</label>
                            <input type="text" name="item_id" id="item_id" 
                                class="w-full border p-2 rounded-md bg-gray-100">
                        </div>

                        <div>
                            <label for="price" class="block font-bold">Price</label>
                            <input type="number" step="0.01" name="price" id="price"
                                class="w-full border p-2 rounded-md bg-gray-100">
                        </div>
                    </div>

<!-- Confirmation Modal -->
<div x-show="showModal" 
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
    <div class="bg-white p-12 rounded-2xl shadow-2xl w-[800px] max-w-[95%] text-center border border-gray-300">

        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-800 mb-12">
            Do you wish to save your changes?
        </h2>

        <!-- Buttons Row (2 columns) -->
        <div class="grid grid-cols-2 gap-32">
            <!-- No Button -->
            <button type="button" 
                    @click="showModal = false"
                    class="w-full py-5 rounded-lg font-bold text-xl text-white bg-red-600 hover:bg-red-700 shadow-lg transition">
                No
            </button>

            <!-- Yes Button -->
            <button type="button" 
                    @click="$refs.menuForm.submit()"
                    class="w-full py-5 rounded-lg font-bold text-xl text-white bg-green-600 hover:bg-green-700 shadow-lg transition">
                Yes
            </button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</x-app-layout>
