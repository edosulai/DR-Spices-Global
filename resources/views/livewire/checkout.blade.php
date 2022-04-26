<div class="main">
    <div class="row">
        <div class="cart-container col-md-8 col-xs-12" id="checkoutForm">

            <div class="checkout-personal-step">
                <h3 class="step-title h3 info" id="headingAddress">
                    {{-- <a role="button" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
                        <span class="step-number">1</span>Shipping Address
                    </a> --}}
                    <span class="step-number">1</span>Shipping Address
                </h3>
            </div>
            <div id="collapseAddress" class="main-content collapse show" aria-labelledby="headingAddress" data-parent="#checkoutForm">
                @if (count($addresses) < 1)
                    <div class="mb-3">
                        <p class="saved-message">{{ __('Your Address Book is Empty,') }} <br> {{ __('Please add the address first before proceeding with the checkout process') }}</p>

                        <x-jet-button class="d-flex align-items-center justify-content-center w-25" wire:click="$toggle('queryAddressModal')">
                            <span wire:loading wire:target="$toggle('queryAddressModal')" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            {{ __('Add New Address') }}
                        </x-jet-button>
                    </div>
                @endif

                <div class="row mb-3">
                    @foreach ($addresses as $address)
                        <div class="col-md-12 mb-3">
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="checkout-personal-step">
                <h3 class="step-title h3 info" id="headingPayment">
                    {{-- <a role="button" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapsePayment" data-parent="#checkoutForm">
                        <span class="step-number">2</span>Payment Method
                    </a> --}}
                    <span class="step-number">2</span>Payment Method
                </h3>
            </div>
            <div id="collapsePayment" class="main-content collapse show" aria-labelledby="headingPayment" data-parent="#checkoutForm">
                <div class="row payment">
                    <div class="col-md-6" wire:ignore>
                        <x-credit-card/>
                    </div>
                    <div class="col-md-6 row">
                        <div class="my-1 col-md-12">
                            <x-jet-label class="small mb-1" for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model="payment.name" maxlength="20" />
                            <x-jet-input-error for="name" />
                        </div>

                        <div class="my-1 col-md-12">
                            <x-jet-label class="small mb-1" for="cardnumber" value="{{ __('Card Number') }}" />
                            <x-jet-input id="cardnumber" type="text" class="{{ $errors->has('cardnumber') ? 'is-invalid' : '' }}" wire:model="payment.cardnumber" maxlength="20" pattern="[0-9]*" inputmode="numeric" />
                            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" wire:ignore>
                            </svg>
                            <x-jet-input-error for="cardnumber" />
                        </div>

                        <div class="my-1 col-md-7">
                            <x-jet-label class="small mb-1" for="expirationdate" value="{{ __('Expiration (mm/yy)') }}" />
                            <x-jet-input id="expirationdate" type="text" class="{{ $errors->has('expirationdate') ? 'is-invalid' : '' }}" wire:model="payment.expirationdate" maxlength="20" pattern="[0-9]*" inputmode="numeric" />
                            <x-jet-input-error for="expirationdate" />
                        </div>

                        <div class="my-1 col-md-5">
                            <x-jet-label class="small mb-1" for="securitycode" value="{{ __('Security Code') }}" />
                            <x-jet-input id="securitycode" type="text" class="{{ $errors->has('securitycode') ? 'is-invalid' : '' }}" wire:model="payment.securitycode" maxlength="20" pattern="[0-9]*" inputmode="numeric" />
                            <x-jet-input-error for="securitycode" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cart-grid-right col-md-4 col-xs-12">
            <div class="bg-primary text-white p-3">YOUR ORDER</div>
            <div class="block-list mt-0">
                <ul class="p-3">
                    @foreach ($carts as $cart)
                        <li class="pt-3">
                            <div class="row">
                                <div class="col-md-2 pr-0">
                                    <img src="{{ $cart['img_src'] }}" alt="{{ $cart['name'] }}" class="img-fluid h-80">
                                </div>
                                <div class="col-md-10">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{ $cart['name'] }}</h6>
                                        <span>{{ currency($cart['qty'] * $cart['price']) }}</span>
                                    </div>
                                    <p>{{ $cart['qty'] }} x {{ currency($cart['price']) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <li class="py-3">
                        Subtotal products:
                        <span class="float-right">{{ currency(
                            $carts->sum(function ($cart) {
                                return ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price'];
                            }),
                        ) }}</span>
                    </li>
                    <li class="py-3">
                        Shipping ({{ $carts->sum(fn($cart) => $cart['qty']) }} x {{ currency($postage->cost) }}) :
                        <span class="float-right">{{ currency($carts->sum(fn($cart) => $cart['qty']) * $postage->cost) }}</span>
                    </li>
                    <li class="py-3">
                        Total products:
                        <span class="float-right">{{ currency(
                            $carts->sum(function ($cart) {
                                return ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price'];
                            }) +
                                $carts->sum(fn($cart) => $cart['qty']) * $postage->cost,
                        ) }}</span>
                    </li>
                </ul>
            </div>

            <div>
                <a role="button" wire:click="getToken" class="continue btn btn-primary btn-block">{{ __('Place Order') }}</a>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="queryAddressModal">
        <x-slot name="title">
            {{ __('Add New Address') }}
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
                    <x-jet-label class="small" for="country_id" value="{{ __('Country') }}" />
                    <select class="form-control form-control-user {{ $errors->has('country_id') ? 'is-invalid' : '' }}" wire:model="modal.country_id" id="country_id" autocomplete="country_id" wire:ignore>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" wire:key="{{ $country->id }}">{{ $country->nicename }}</option>
                        @endforeach
                    </select>
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

    <x-jet-confirmation-modal wire:model="warningModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ $status_message }}
        </x-slot>

        <x-slot name="content">
            <ul class="list-group list-group-flush">
                @foreach ($validation_messages as $messages)
                <li class="list-group-item pl-0"><i>{{ $messages }}</i></li>
                @endforeach
            </ul>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('warningModal')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

