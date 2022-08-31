<x-guest-layout>
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('app.Email Address')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('app.Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-2' : 'mr-2' }} text-sm text-gray-600">{{ __('app.Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-3' : 'mr-3' }}">
                    {{ __('app.Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
