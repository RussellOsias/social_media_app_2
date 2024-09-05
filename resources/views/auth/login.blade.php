<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="retro-form">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <x-input-label for="email" :value="__('Email')" class="label" />
            <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error" />
        </div>

        <!-- Password -->
        <div class="input-group mt-4">
            <x-input-label for="password" :value="__('Password')" class="label" />
            <x-text-input id="password" class="input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="error" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center remember-me">
                <input id="remember_me" type="checkbox" class="checkbox" name="remember">
                <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-gray-300" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('register') }}" class="register-button">
                {{ __('Dont have an account? Register here!') }}
            </a>
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

        .checkbox {
            accent-color: #f00;
        }

        .remember-me span {
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

        .register-button {
            color: #f00;
            text-decoration: underline;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .register-button:hover {
            color: #c00;
        }
    </style>
</x-guest-layout>
