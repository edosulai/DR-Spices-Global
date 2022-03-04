<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            <div class="mb-3 text-sm text-muted">
                {{ __('Ini adalah area aplikasi yang aman. Harap konfirmasi sandi Anda sebelum melanjutkan.') }}
            </div>

            <x-jet-validation-errors class="mb-2" />

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-jet-button class="ms-4">
                        {{ __('Konfirmasi') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
