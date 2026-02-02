<x-app-layout>
    @section('title', 'Homepage')

    <div class="py-12 bg-[#A0C878] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-8 lg:px-8">
            <!-- Main white container -->
            <div class="bg-white shadow-xl sm:rounded-lg p-12">
                
                <!-- Welcome message centered -->
                <h1 class="text-4xl font-bold text-center mb-12">Manager Homepage</h1>

                <!-- Action buttons centered + stacked vertically -->
                <div class="flex flex-col items-center space-y-6">
                    <a href="{{ route('menu.manage') }}"
                       class="w-80 px-8 py-5 bg-blue-600 text-white text-xl font-semibold rounded-lg shadow hover:bg-blue-700 transition text-center">
                       Menu Items
                    </a>

                    <a href="{{ route('users.index') }}"
                       class="w-80 px-8 py-5 bg-green-600 text-white text-xl font-semibold rounded-lg shadow hover:bg-green-700 transition text-center">
                       User Accounts
                    </a>

                    <a href="{{ route('reports.sales') }}"
                       class="w-80 px-8 py-5 bg-purple-600 text-white text-xl font-semibold rounded-lg shadow hover:bg-purple-700 transition text-center">
                       View Sales Reports
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
