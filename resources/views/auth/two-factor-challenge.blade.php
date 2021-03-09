<x-app-layout>

    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <p>
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </p>

        <div>
            <label>{{ __('Code') }}</label>
            <input type="text" name="code" required autofocus />
        </div>

        <div>
            <button>
                {{ __('Login') }}
            </button>
        </div>
    </form>
</x-app-layout>
