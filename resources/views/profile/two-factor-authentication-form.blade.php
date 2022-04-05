<x-jet-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold">
            @if ($this->enabled)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not activated two factor authentication.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('If the authentication of two factors is activated, you will be asked for a random token that is safe during authentication.You can take this token from your mobile Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3">
                    {{ __('Authentication of two factors is now activated.Scan the following QR code using your mobile autoenticator application.') }}
                </p>

                <div class="mt-3">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3">
                    {{ __('Save this recovery code in a safe password manager.The code can be used to restore access to your account if your two-factor authentication device is lost.') }}
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
                    <x-jet-button class="btn-block d-flex align-items-center justify-content-center" type="button" wire:loading.attr="disabled">
                        <span wire:loading class="spinner-border spinner-border-sm mr-2" role="status"></span>
                        {{ __('Activate') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-2">
                            <span wire:loading wire:target="regenerateRecoveryCodes" class="spinner-border spinner-border-sm" role="status"></span>
                            {{ __('Reset the recovery code') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-2">
                            <span wire:loading wire:target="showRecoveryCodes" class="spinner-border spinner-border-sm" role="status"></span>
                            {{ __('Show recovery code') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="disableTwoFactorAuthentication">
                        <span wire:loading wire:target="disableTwoFactorAuthentication" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                        {{ __('Deactivate') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
