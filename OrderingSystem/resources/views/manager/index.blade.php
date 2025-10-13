<x-app-layout>
    @section('title', 'Account Manage')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">

                <h2 class="text-2xl font-bold mb-6">Manage Users</h2>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Customer ID</th>
                            <th class="border border-gray-300 px-4 py-2">Username</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Contact Number</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <!-- ✅ Corrected: use id, name, email, contact_number -->
<td class="border border-gray-300 px-4 py-2">UID{{ 1000 + $user->id }}</td>
<td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
<td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
<td class="border border-gray-300 px-4 py-2">{{ $user->contact_number ?? 'N/A' }}</td>
<td class="border border-gray-300 px-2 py-1 text-center w-40">
    <a href="{{ route('users.edit', $user->id) }}"
       class="inline-block bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600 mr-2">
       Edit
    </a>

    <div class="inline-block">
        <form action="{{ route('users.destroy', $user->id) }}" 
              method="POST"
              onsubmit="return confirm('Are you sure you want to remove this user?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600">
                Remove
            </button>

        </form>
    </div>
</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
