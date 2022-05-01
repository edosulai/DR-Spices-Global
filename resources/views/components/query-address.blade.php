@props(['id' => null, 'maxWidth' => null, 'saveAction' => null, 'headTitle' => null, 'countries' => [], 'modal' => []])

<x-jet-dialog-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <x-slot name="title">
        {{ $headTitle }}
    </x-slot>

    <x-slot name="content">
        <div class="row py-0">
            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="recipent" value="{{ __('Recipent Name') }}" />
                <x-jet-input id="recipent" type="text" class="{{ $errors->has('recipent') ? 'is-invalid' : '' }}" wire:model.defer="modal.recipent" />
                <x-jet-input-error for="recipent" />
            </div>
            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="phone" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phone" type="text" class="{{ $errors->has('phone') ? 'is-invalid' : '' }} phone" wire:model.defer="modal.phone" />
                <x-jet-input-error for="phone" />
            </div>

            <div class="my-2 col-md-12">
                <x-jet-label class="small" for="street" value="{{ __('Address Line 1') }}" />
                <x-jet-input id="street" type="text" class="{{ $errors->has('street') ? 'is-invalid' : '' }}" wire:model.defer="modal.street" />
                <x-jet-input-error for="street" />
            </div>

            <div class="my-2 col-md-8">
                <x-jet-label class="small" for="other_street" value="{{ __('Address Line 2') }}" />
                <x-jet-input id="other_street" type="text" class="{{ $errors->has('other_street') ? 'is-invalid' : '' }}" wire:model.defer="modal.other_street" />
                <x-jet-input-error for="other_street" />
            </div>

            <div class="my-2 col-md-4">
                <x-jet-label class="small" for="zip" value="{{ __('Postal Code') }}" />
                <x-jet-input id="zip" type="text" class="{{ $errors->has('zip') ? 'is-invalid' : '' }}" wire:model.defer="modal.zip" />
                <x-jet-input-error for="zip" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="district" value="{{ __('Discrict') }}" />
                <x-jet-input id="district" type="text" class="{{ $errors->has('district') ? 'is-invalid' : '' }}" wire:model.defer="modal.district" />
                <x-jet-input-error for="district" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="city" value="{{ __('City/Region') }}" />
                <x-jet-input id="city" type="text" class="{{ $errors->has('city') ? 'is-invalid' : '' }}" wire:model.defer="modal.city" />
                <x-jet-input-error for="city" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="state" value="{{ __('State/Province') }}" />
                <x-jet-input id="state" type="text" class="{{ $errors->has('state') ? 'is-invalid' : '' }}" wire:model.defer="modal.state" />
                <x-jet-input-error for="state" />
            </div>

            <div class="my-2 col-md-6">
                <x-jet-label class="small" for="country_id" value="{{ __('Country') }}" />
                <select class="form-control form-control-user {{ $errors->has('country_id') ? 'is-invalid' : '' }}" wire:model="modal.country_id" id="country_id" autocomplete="country_id" wire:ignore>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" wire:key="{{ $country->id }}" {!! array_key_exists('country_id', $modal) ? ($modal['country_id'] == $country->id ? 'selected' : '') : '' !!}>{{ $country->nicename }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="country" />
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