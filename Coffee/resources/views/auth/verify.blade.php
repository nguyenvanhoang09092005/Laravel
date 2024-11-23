<x-guest-layout>
    <form class="form" method="POST" action="{{ route('verify.store') }}">
        @csrf

        <!-- Close Button -->
        <span class="close">X</span>

        <!-- Title and Description -->
        <div class="info">
            <span class="title">{{ __('Two-Factor Verification') }}</span>
            <p class="description">
                {{ __('Enter the two-factor authentication code provided by the authenticator app.') }}</p>
        </div>

        <!-- OTP Inputs -->
        <div class="input-fields">
            @for ($i = 1; $i <= 6; $i++)
                <input id="otp-{{ $i }}" type="tel" maxlength="1" name="otp[]" required
                    oninput="moveToNext(this, {{ $i }})" />
            @endfor
        </div>

        <x-input-error :messages="$errors->get('otp')" class="mt-2" />

        <!-- Action Buttons -->
        <div class="action-btns">
            <button type="submit" class="verify">{{ __('Verify') }}</button>
            <button type="reset" class="clear">{{ __('Clear') }}</button>
        </div>
    </form>

    {{-- <script>
        function moveToNext(currentInput, index) {
            const nextInput = document.getElementById(`otp-${index + 1}`);
            if (currentInput.value.length === 1 && nextInput) {
                nextInput.focus();
            }
        }
    </script> --}}
</x-guest-layout>
<style>
    .form {
        --black: #000000;
        --ch-black: #141414;
        --eer-black: #1b1b1b;
        --night-rider: #2e2e2e;
        --white: #ffffff;
        --af-white: #f3f3f3;
        --ch-white: #e1e1e1;
        --tomato: #fa5656;
        font-family: Helvetica, sans-serif;
        border: 2px solid var(--ch-white);
        padding: 25px;
        display: flex;
        max-width: 620px;
        flex-direction: column;
        align-items: center;
        overflow: hidden;
        color: var(--night-rider);
        background-color: var(--white);
        border-radius: 8px;
        position: relative;
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.15);
    }

    /* Title and Description */
    .info {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .title {
        font-size: 1.5rem;
        font-weight: 900;
    }

    .description {
        margin-top: 10px;
        font-size: 1rem;
    }

    /* OTP Input Fields */
    .input-fields {
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }

    .input-fields input {
        height: 2.5em;
        width: 2.5em;
        outline: none;
        text-align: center;
        font-family: 'Trebuchet MS', Arial, sans-serif;
        font-size: 1.5rem;
        color: var(--ch-black);
        border-radius: 5px;
        border: 2.5px solid var(--ch-white);
        background-color: var(--ch-white);
    }

    .input-fields input:focus {
        border: 1px solid var(--night-rider);
        box-shadow: inset 10px 10px 10px rgba(0, 0, 0, 0.15);
        transform: scale(1.05);
        transition: 0.5s;
    }

    /* Action Buttons */
    .action-btns {
        display: flex;
        margin-top: 20px;
        gap: 0.5rem;
    }

    /* Verify Button */
    .verify {
        padding: 12px 25px;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        color: var(--white);
        background: linear-gradient(135deg, #00bcd4, #009688);
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    }

    .verify:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 188, 212, 0.4);
        background: linear-gradient(135deg, #009688, #00796b);
    }

    .verify:active {
        transform: translateY(1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    /* Clear Button */
    .clear {
        padding: 12px 25px;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        color: #ff5252;
        background: transparent;
        border: 2px solid #ff5252;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
    }

    .clear:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(255, 82, 82, 0.4);
        background: #ff5252;
        color: #fff;
    }

    .clear:active {
        transform: translateY(1px);
        box-shadow: 0 4px 6px rgba(255, 82, 82, 0.2);
    }


    /* Close Button */
    .close {
        position: absolute;
        right: 10px;
        top: 10px;
        background-color: var(--ch-white);
        color: var(--af-white);
        height: 30px;
        width: 30px;
        display: grid;
        place-items: center;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.5s ease;
    }

    .close:hover {
        background-color: var(--tomato);
        color: var(--white);
    }
</style>
