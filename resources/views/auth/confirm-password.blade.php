<x-guest-layout>
    <div class="retro-message">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="retro-form">
        @csrf

        <!-- Password -->
        <div class="input-group">
            <x-input-label for="password" :value="__('Password')" class="label" />

            <x-text-input id="password" class="input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="error" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="button">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>

    <style>
        .retro-form {
            background-color: #111;
            color: #eee;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            max-width: 400px;
            margin: auto;
            font-family: 'Courier New', Courier, monospace;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .label {
            color: #f00;
            font-weight: bold;
        }

        .input {
            background-color: #222;
            border: 1px solid #f00;
            color: #eee;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
        }

        .input:focus {
            border-color: #f00;
            outline: none;
        }

        .error {
            color: #f00;
        }

        .button {
            background-color: #f00;
            color: #111;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            font-weight: bold;
        }

        .button:hover {
            background-color: #c00;
        }

        .button:focus {
            outline: 2px solid #c00;
        }

        .retro-message {
            color: #eee;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
    </style>
</x-guest-layout>
