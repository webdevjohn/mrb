<x-simple-layout>
    <x-slot name="title">Login</x-slot>

    <div id="form-con" class="center">

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />
  
        <form method="POST" action="{{ route('login') }}">
            @csrf
     
            <a href="{{ route('homepage') }}">MyRecordBox</a>
            
            <!-- Email -->            
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
            
            <!-- Password -->            
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" />
                                    
            <button>
                {{ __('Login') }}
            </button>      
        </form>
    </div>
</x-simple-layout>
