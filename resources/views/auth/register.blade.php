<x-app-layout>
    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email -->
        <label for="email">Email</label>
        <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus />
        
        <!-- Password -->
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password" />

        <!-- Confirm Password -->
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required />
        
        <div>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button>
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-app-layout>
