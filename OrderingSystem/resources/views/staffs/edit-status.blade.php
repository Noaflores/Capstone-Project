<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Edit Order Status</h1>

            <form method="POST" action="{{ route('staff.orders.updateStatus', $orderItem->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Item ID:</label>
                    <input type="text" value="{{ $orderItem->id }}" disabled
                           class="w-full border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
                    <select name="status" id="status"
                            class="w-full border-gray-300 rounded-lg px-3 py-2">
                        <option value="Pending" {{ $orderItem->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $orderItem->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $orderItem->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('staff.orders') }}" 
                       class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
