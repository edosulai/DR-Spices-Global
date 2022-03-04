<x-jet-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Tambahkan keamanan tambahan ke akun Anda menggunakan otentikasi dua faktor.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold">
            @if ($this->enabled)
                {{ __('Anda telah mengaktifkan otentikasi dua faktor.') }}
            @else
                {{ __('Anda belum mengaktifkan otentikasi dua faktor.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('Bila autentikasi dua faktor diaktifkan, Anda akan dimintai token acak yang aman selama autentikasi. Anda dapat mengambil token ini dari aplikasi Google Authenticator ponsel Anda.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3">
                    {{ __('Otentikasi dua faktor sekarang diaktifkan. Pindai kode QR berikut menggunakan aplikasi autentikator ponsel Anda.') }}
                </p>

                <div class="mt-3">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3">
                    {{ __('Simpan kode pemulihan ini di pengelola kata sandi yang aman. Kode tersebut dapat digunakan untuk memulihkan akses ke akun Anda jika perangkat autentikasi dua faktor Anda hilang.') }}
                </p>

                <div class="bg-light rounded p-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-3">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Aktifkan') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="me-3">
                            <div wire:loading wire:target="regenerateRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                
                            </div>

                            {{ __('Buat Ulang Kode Pemulihan') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="me-3">
                            <div wire:loading wire:target="showRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                                
                            </div>

                            {{ __('Tampilkan Kode Pemulihan') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        <div wire:loading wire:target="disableTwoFactorAuthentication" class="spinner-border spinner-border-sm" role="status">
                            
                        </div>

                        {{ __('Nonaktifkan') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>