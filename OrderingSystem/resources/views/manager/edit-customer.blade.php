<x-app-layout>
    @section('title', 'Edit Customer')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6">Edit User</h2>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ $user->name }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ $user->email }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text"
                               name="contact_number"
                               value="{{ $user->contact_number }}"
                               pattern="[0-9]{11}"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               required>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('users.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Back
                        </a>

                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
