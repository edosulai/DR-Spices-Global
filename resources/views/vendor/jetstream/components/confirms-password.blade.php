@props(['title' => __('Password confirmation'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
$confirmableId = md5($attributes->wire('then'));
@endphp

<span {{ $attributes->wire('then') }} x-data x-ref="span" x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')" x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);">
    {{ $slot }}
</span>

@once
<x-jet-dialog-modal wire:model="confirmingPassword">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="content">
        {{ $content }}

        <div class="mt-4" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <x-jet-input type="password" class="{{ $errors->has('confirmable_password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" x-ref="confirmable_password" wire:model.defer="confirmablePassword" wire:keydown.enter="confirmPassword" />
            <x-jet-input-error for="confirmable_password" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="d-flex">
            <x-jet-secondary-button class="mr-2" wire:click="$toggle('confirmingPassword')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="d-flex align-items-center" wire:click="confirmPassword" wire:loading.attr="disabled">
                <span wire:loading wire:target="confirmPassword" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __($button) }}
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-dialog-modal>
@endonce