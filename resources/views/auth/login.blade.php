<x-app-layout>

    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->            
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
        
        <!-- Password -->            
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" />
        
        <!-- Remember Me -->
        <label for="remember_me">
            <input id="remember_me" type="checkbox" name="remember">
            <span>{{ __('Remember me') }}</span>
        </label>
        
        <div>            
            <button>
                {{ __('Login') }}
            </button>
        </div>
    </form>
</x-app-layout>
