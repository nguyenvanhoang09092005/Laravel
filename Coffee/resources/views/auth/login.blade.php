<style>
    .form-header {
        text-align: center;
        margin-bottom: 20px;
    }

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Playfair+Display:wght@700&display=swap');

    .form-title {
        text-align: center;
        font-size: 36px;
        color: #3e2723;
        /* Màu cà phê đậm */
        font-family: 'Cinzel', serif;
        /* Font Cinzel sang trọng */
        font-weight: bold;
        letter-spacing: 2px;
    }
</style>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="form-header">

        <h2 class="form-title">Login</h2>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>



        <!-- Remember Me -->
        <div class="block mt-4 flex justify-between items-center">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Reset password') }}
                </a>
            @endif
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                {{ __('You don\'t have an account?') }}
            </a>



            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
