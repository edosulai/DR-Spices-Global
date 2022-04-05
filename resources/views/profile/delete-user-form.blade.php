<x-jet-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Delete your account permanently.') }}
    </x-slot>

    <x-slot name="content">
        <div>
            {{ __('After your account is deleted, all resources and the data will be permanently deleted.Before deleting your account, please download data or whatever information you want to save.') }}
        </div>

        <div class="mt-3">
            <x-jet-danger-button class="d-flex align-items-center" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                <span wire:loading wire:target="confirmUserDeletion" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </div>


        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your account?After your account is deleted, all resources and the data will be permanently deleted.Please enter your password to confirm that you want to permanently delete your account.') }}

                <div class="mt-2 w-md-75" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteUser">
                    <span wire:loading wire:target="deleteUser" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>

</x-jet-action-section>
