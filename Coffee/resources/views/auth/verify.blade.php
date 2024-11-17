<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Enter your 6-digit OTP to verify your account.') }}
    </div>

    <form method="POST" action="{{ route('verify.store') }}">
        @csrf

        <!-- OTP Inputs -->
        <div class="flex justify-center space-x-2">
            @for ($i = 1; $i <= 6; $i++)
                <x-text-input id="otp-{{ $i }}"
                    class="block w-12 h-12 text-center border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-lg"
                    type="text" name="otp[]" maxlength="1" required autofocus />
            @endfor
        </div>
        <x-input-error :messages="$errors->get('otp')" class="mt-2" />

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
