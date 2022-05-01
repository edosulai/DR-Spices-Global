<div class="myaccount-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Address Books') }}</h1>
    </div>

    <div class="row">
        @foreach ($addresses as $address)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm{{ $address['primary'] ? ' border-dark' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5><b>{{ $address['recipent'] }}</b></h5>
                            @if ($address['primary'])
                                <span>
                                    <i class="fas fa-check"></i>
                                    <span>{{ __('Main') }}</span>
                                </span>
                            @else
                                <button role="button" class="btn p-0 m-0" wire:click="mainAddress('{{ $address['id'] }}')">
                                    <i class="far fa-square"></i>
                                </button>
                            @endif
                        </div>
                        <p>{{ $address['phone'] }}</p>
                        <p>{{ $address['street'] }}, {{ $address['other_street'] }}</p>
                        <p>{{ $address['countries_nicename'] }}</p>
                        <div class="d-flex">
                            <a role="button" wire:click="openModalAddress('{{ $address['id'] }}')">
                                <i class="fas fa-edit"></i>
                                <span>{{ __('Edit Address') }}</span>
                            </a>
                            <div class="mx-3">|</div>
                            <a role="button" wire:click="openDeleteModal('{{ $address['id'] }}')">
                                <i class="far fa-trash-alt"></i>
                                <span>{{ __('Delete Address') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($addresses) < 1)
            <div class="mb-3 w-100">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="d-flex justify-content-center">
                            <h5 class="font-weight-bold">{{ __('No Address Found') }}</h5>
                        </div>
                        <p class="text-center">{{ __('Please add the address first before proceeding with the checkout process') }}</p>
                        <button class="btn icon-address" wire:click="openModalAddress">
                            <span><i class="fas fa-plus"></i></span>
                            <h6 class="text-center mt-3">{{ __('Add New Address') }}</h6>
                        </button>
                    </div>
                </div>
            </div>
        @elseif (count($addresses) % 2 == 1)
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <p class="text-center">{{ __('Consider adding another address to continue the checkout process') }}</p>
                        <button class="btn icon-address" wire:click="openModalAddress">
                            <span><i class="fas fa-plus"></i></span>
                            <h6 class="text-center mt-3">{{ __('Add Other Address') }}</h6>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <x-query-address wire:model="queryAddressModal" :saveAction="'queryAddress'" :headTitle="$headerAddressModal" :countries="$countries" :modal="$modal" />
    <x-delete-address wire:model="deleteAddressModal" :deleteAction="'deleteAddress'" />

</div>
