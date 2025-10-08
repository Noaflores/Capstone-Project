<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="current_password" :value="__('Current Password')" />
            <input id="current_password" name="current_password"
                   :type="show ? 'text' : 'password'"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500"
                   autocomplete="current-password" />
            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-8 text-gray-400 hover:text-gray-200 focus:outline-none">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 013.75-5.042M15 12a3 3 0 00-4.243-4.243M9.88 9.88L3 3m18 18l-3.588-3.588" />
                </svg>
            </button>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="password" :value="__('New Password')" />
            <input id="password" name="password"
                   :type="show ? 'text' : 'password'"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500"
                   autocomplete="new-password" />
            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-8 text-gray-400 hover:text-gray-200 focus:outline-none">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 013.75-5.042M15 12a3 3 0 00-4.243-4.243M9.88 9.88L3 3m18 18l-3.588-3.588" />
                </svg>
            </button>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <input id="password_confirmation" name="password_confirmation"
                   :type="show ? 'text' : 'password'"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring-indigo-500"
                   autocomplete="new-password" />
            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-8 text-gray-400 hover:text-gray-200 focus:outline-none">
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 013.75-5.042M15 12a3 3 0 00-4.243-4.243M9.88 9.88L3 3m18 18l-3.588-3.588" />
                </svg>
            </button>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
