<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('postage-table')
        </div>
    </div>

    <x-jet-dialog-modal wire:model="postageModal">
        <x-slot name="title">
            {{ __('Edit Ongkos Kirim') }}
        </x-slot>

        <x-slot name="content">

            <div class="mb-3">
                <x-jet-label class="small" for="form.countries_name" value="{{ __('Negara') }}" />
                <x-jet-input id="form.countries_name" type="text" class="{{ $errors->has('form.countries_name') ? 'is-invalid' : '' }}" wire:model="form.countries_name" autocomplete="form.countries_name" disabled/>
                <x-jet-input-error for="form.countries_name" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.cost" value="{{ __('Ongkos Kirim') }}" />
                <x-jet-input id="form.cost" type="number" class="{{ $errors->has('form.cost') ? 'is-invalid' : '' }}" wire:model="form.cost" autocomplete="form.cost" />
                <x-jet-input-error for="form.cost" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="d-flex">
                <x-jet-secondary-button class="mr-2" wire:click="$toggle('postageModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="d-flex align-items-center" wire:click="editPostage" wire:loading.attr="disabled">
                    <span wire:loading wire:target="editPostage" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    {{ __('Edit') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
