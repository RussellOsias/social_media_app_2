<x-guest-layout>
    <div class="retro-message">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="retro-form">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" class="label" />
            <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="error" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="button">
                {{ __('Email Password Reset Link') }}
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
