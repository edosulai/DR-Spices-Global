@props(['id' => null, 'maxWidth' => null, 'deleteAction' => null])

<x-jet-confirmation-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <x-slot name="title">
        {{ __('Delete Address') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you would like to delete this Address?') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('{{ $attributes['wire:model'] }}')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="{{ $deleteAction }}">
            <span wire:loading wire:target="{{ $deleteAction }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
            {{ __('Delete') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
