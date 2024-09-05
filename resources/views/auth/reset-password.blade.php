<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="retro-form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" class="label" />
            <x-text-input id="email" class="input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error" />
        </div>

        <!-- Password -->
        <div class="input-group mt-4">
            <x-input-label for="password" :value="__('Password')" class="label" />
            <x-text-input id="password" class="input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="error" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="label" />
            <x-text-input id="password_confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button">
                {{ __('Reset Password') }}
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
    </style>
</x-guest-layout>
