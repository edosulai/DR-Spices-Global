<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update the password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Make sure your account uses a long random password to stay safe.') }}
    </x-slot>

    <x-slot name="form">
        <div class="w-md-75">
            <div class="mb-3">
                <x-jet-label class="small" for="current_password" value="{{ __('Current Password') }}" />
                <x-jet-input id="current_password" type="password" class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-jet-input-error for="current_password" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="password" value="{{ __('New Password') }}" />
                <x-jet-input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password" autocomplete="new-password" />
                <x-jet-input-error for="password" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <x-jet-input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-jet-input-error for="password_confirmation" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
		<div class="d-flex align-items-baseline">
            <x-jet-button class="d-flex align-items-center justify-content-center">
                <span wire:loading class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Save') }}
            </x-jet-button>
		</div>
    </x-slot>
</x-jet-form-section>
