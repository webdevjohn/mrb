<x-app-layout>

    <div>
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" :value="__('Password')"></label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />      
        </div>

        <div>
            <button>
                {{ __('Confirm') }}
            </button>
        </div>      
    </form>
</x-app-layout>
