<x-app-layout>
    @section('title', 'User Management')

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">

                <h1 class="text-2xl font-bold mb-6">Employees</h1>

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2 text-left">Email</th>
                            <th class="border px-4 py-2 text-left">Contact Number</th>
                            <th class="border px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">
                                    {{ $user->name }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $user->email }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ substr($user->contact_number, 0, 4) . '****' . substr($user->contact_number, -3) }}
                                </td>

                                <td class="border px-4 py-2">
                                    <div class="flex justify-center gap-2">
    <!-- Edit -->
    <a href="{{ route('users.edit', $user->id) }}"
       class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
        Edit
    </a>

    <!-- Delete -->
    <form action="{{ route('users.destroy', $user->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this user?')">
        @csrf
        @method('DELETE')
        <button
            class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
            Delete
        </button>
    </form>
</div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
