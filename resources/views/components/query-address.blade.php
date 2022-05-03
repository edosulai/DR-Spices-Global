@props(['id' => null, 'maxWidth' => null, 'saveAction' => null, 'headTitle' => null, 'countries' => [], 'modal' => []])

<x-jet-dialog-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <x-slot name="title">
        {{ $headTitle }}
    </x-slot>

    <x-slot name="content">
        <div class="row py-0">
            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.recipent" value="{{ __('Recipent Name') }}" />
                <x-jet-input id="modal.recipent" type="text" class="{{ $errors->has('modal.recipent') ? 'is-invalid' : '' }}" wire:model="modal.recipent" />
                <x-jet-input-error for="modal.recipent" />
            </div>
            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.phone" value="{{ __('Phone Number') }}" />
                <x-jet-input id="modal.phone" type="text" class="{{ $errors->has('modal.phone') ? 'is-invalid' : '' }}" wire:model="modal.phone" />
                <x-jet-input-error for="modal.phone" />
            </div>

            <div class="my-2 col-md-12">
                <x-jet-label class="small" for="modal.street" value="{{ __('Address Line 1') }}" />
                <x-jet-input id="modal.street" type="text" class="{{ $errors->has('modal.street') ? 'is-invalid' : '' }}" wire:model="modal.street" />
                <x-jet-input-error for="modal.street" />
            </div>

            <div class="my-2 col-md-8">
                <x-jet-label class="small" for="modal.other_street" value="{{ __('Address Line 2') }}" />
                <x-jet-input id="modal.other_street" type="text" class="{{ $errors->has('modal.other_street') ? 'is-invalid' : '' }}" wire:model="modal.other_street" />
                <x-jet-input-error for="modal.other_street" />
            </div>

            <div class="my-2 col-md-4">
                <x-jet-label class="small" for="modal.zip" value="{{ __('Postal Code') }}" />
                <x-jet-input id="modal.zip" type="text" class="{{ $errors->has('modal.zip') ? 'is-invalid' : '' }}" wire:model="modal.zip" />
                <x-jet-input-error for="modal.zip" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.district" value="{{ __('Discrict') }}" />
                <x-jet-input id="modal.district" type="text" class="{{ $errors->has('modal.district') ? 'is-invalid' : '' }}" wire:model="modal.district" />
                <x-jet-input-error for="modal.district" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.city" value="{{ __('City/Region') }}" />
                <x-jet-input id="modal.city" type="text" class="{{ $errors->has('modal.city') ? 'is-invalid' : '' }}" wire:model="modal.city" />
                <x-jet-input-error for="modal.city" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.state" value="{{ __('State/Province') }}" />
                <x-jet-input id="modal.state" type="text" class="{{ $errors->has('modal.state') ? 'is-invalid' : '' }}" wire:model="modal.state" />
                <x-jet-input-error for="modal.state" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="modal.country_id" value="{{ __('Country') }}" />
                <select id="modal.country_id" class="form-control form-control-user {{ $errors->has('modal.country_id') ? 'is-invalid' : '' }}" wire:model.defer="modal.country_id" autocomplete="country_id">
                    <option {!! array_key_exists('country_id', $modal) ? 'disabled' : 'selected' !!}>--Please choose--</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" wire:key="{{ $country->id }}" {!! array_key_exists('country_id', $modal) ? ($modal['country_id'] == $country->id ? 'selected' : '') : '' !!}>{{ $country->nicename }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="modal.country_id" />
            </div>

        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('{{ $attributes['wire:model'] }}')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="{{ $saveAction }}">
            <span wire:loading wire:target="{{ $saveAction }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
