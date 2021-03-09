<x-app-layout>
    <form method="POST" action="{{url("/user/two-factor-authentication")}}">
            @csrf

            <div>
                <button>
                    {{ __('Enable 2fa') }}
                </button>
            </div>
        </form>

    @if (session('status') == 'two-factor-authentication-enabled')
        <div>
            Two factor authentication has been enabled.
            {!! Auth::user()->twoFactorQrCodeSvg() !!} 
        </div>
    @endif
</x-app-layout>