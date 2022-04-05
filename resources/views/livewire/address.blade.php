<div class="myaccount-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Address Books') }}</h1>

        @if ($addresses->count() < 2)
            <x-jet-button class="d-flex align-items-center justify-content-center w-25" wire:click="openModalAddress">
                <span wire:loading wire:target="openModalAddress" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Add New Address') }}
            </x-jet-button>
        @endif
    </div>

    @if ($addresses->count() < 1)
        <p class="saved-message">{{ __('Your Address Book is Empty') }}</p>
    @endif

    <div class="row">
        @foreach ($addresses as $address)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm{{ $address->primary ? ' border-dark' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5><b>{{ $address->recipent }}</b></h5>
                            @if ($address->primary)
                                <span>
                                    <i class="fas fa-check"></i>
                                    <span>{{ __('Main') }}</span>
                                </span>
                            @else
                                <button role="button" class="btn p-0 m-0" wire:click="mainAddress('{{ $address->id }}')">
                                    <i class="far fa-square"></i>
                                </button>
                            @endif
                        </div>
                        <p>{{ $address->phone }}</p>
                        <p>{{ $address->street }} {{ $address->other_street }}</p>
                        <p>{{ $address->country }}</p>
                        <div class="d-flex">
                            <a role="button" wire:click="openModalAddress('{{ $address->id }}')">
                                <i class="fas fa-edit"></i>
                                <span>{{ __('Edit Address') }}</span>
                            </a>
                            <div class="mx-3">|</div>
                            <a role="button" wire:click="openConfirmModal('{{ $address->id }}')">
                                <i class="far fa-trash-alt"></i>
                                <span>{{ __('Delete Address') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-jet-dialog-modal wire:model="queryAddressModal">
        <x-slot name="title">
            {{ __('Update Address') }}
        </x-slot>

        <x-slot name="content">
            <div class="row">
                <div class="my-2 col-md-6">
                    <x-jet-label class="small" for="recipent" value="{{ __('Recipent Name') }}" />
                    <x-jet-input id="recipent" type="text" class="{{ $errors->has('recipent') ? 'is-invalid' : '' }}" wire:model.defer="modal.recipent" />
                    <x-jet-input-error for="recipent" />
                </div>
                <div class="my-2 col-md-6">
                    <x-jet-label class="small" for="phone" value="{{ __('Phone Number') }}" />
                    <x-jet-input id="phone" type="text" class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" wire:model.defer="modal.phone" />
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
                    <x-jet-label class="small" for="country" value="{{ __('Country') }}" />
                    <x-jet-input id="country" type="text" class="{{ $errors->has('country') ? 'is-invalid' : '' }}" wire:model.defer="modal.country" />
                    <x-jet-input-error for="country" />
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('queryAddressModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="queryAddress">
                <span wire:loading wire:target="queryAddress" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="deleteAddressModal">
        <x-slot name="title">
            {{ __('Delete Address') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this Address?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteAddressModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteAddress">
                <span wire:loading wire:target="deleteAddress" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</div>
