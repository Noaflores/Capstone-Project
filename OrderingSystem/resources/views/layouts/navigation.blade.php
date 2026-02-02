<nav class="relative z-50 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('images/CafeLogo.jpg') }}"
                             alt="Cafe Logo"
                             class="h-20 w-20 rounded-full border-2 border-gray-400 object-cover" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link 
                        :href="route('homepage')" 
                        :active="request()->routeIs('homepage')" 
                        class="text-xl align-middle"
                    >
                        {{ __('Homepage') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                @if(Auth::check())
                    <div x-data="{ open: false }" class="relative">
                        <!-- Trigger -->
                        <button @click="open = !open" class="inline-flex items-center px-3 py-2 border border-transparent text-lg font-semibold rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
<div 
    x-show="open" 
    x-cloak
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg py-1 z-50"
>
    <x-dropdown-link 
        :href="route('profile.edit')" 
        class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition"
    >
        {{ __('Profile') }}
    </x-dropdown-link>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link 
            :href="route('logout')"
            onclick="event.preventDefault(); this.closest('form').submit();"
            class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition"
        >
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 dark:text-gray-300 px-3">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 dark:text-gray-300 px-3">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
