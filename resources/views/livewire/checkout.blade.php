<div class="cart-grid">
    <div class="row">
        <div class="cart-container col-md-9 col-xs-12" id="checkoutForm">
            <div class="checkout-personal-step">
                <h3 class="step-title h3 info" id="headingAddress">
                    <a role="button" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
                        <span class="step-number">1</span>Addresses
                    </a>
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="checkout-personal-step">
                <h3 class="step-title h3 info" id="headingPayment">
                    <a role="button" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapsePayment" data-parent="#checkoutForm">
                        <span class="step-number">2</span>Payment
                    </a>
                </h3>
            </div>
            <div id="collapsePayment" class="main-content collapse" aria-labelledby="headingPayment">
                <form action="#" method="post">
                    <div>
                        <input type="hidden" name="id_customer" value="">
                        <div class="form-group row">
                            <input class="form-control" name="firstname" type="text" placeholder="Full name">
                        </div>
                        <div class="form-group row">
                            <input class="form-control" name="email" type="email" placeholder="Email">
                        </div>
                        <div class="form-group row">
                            <input class="form-control" name="email" type="email" placeholder="Phone">
                        </div>
                        <div class="desc-password">
                            <span class="font-weight-bold">Create an account</span>
                            <span>(optional)</span>
                            <br>
                            <span class="text-muted">And save time on your next order!</span>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <input class="form-control" name="password" type="password" placeholder=" Password">
                            </div>
                        </div>
                        <div class="hidden-comment">
                            <div class="form-group row">
                                <input class="form-control" name="birthday" type="text" value="" placeholder=" Birthdate">
                            </div>
                        </div>
                        <div class="form-group row check-input">
                            <span class="custom-checkbox d-inline-flex">
                                <input class="check" name="optin" type="checkbox" value="1">
                                <label class="label-absolute">Receive offers from our partners</label>
                            </span>
                        </div>
                        <div class="form-group row">
                            <span class="custom-checkbox d-inline-flex check-input">
                                <input class="check" name="newsletter" type="checkbox" value="1">
                                <label>Sign up for our newsletter
                                    <br>
                                    <em>You may unsubscribe at any moment. For that purpose,
                                        please find our contact info in the legal notice.
                                    </em>
                                </label>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="cart-grid-right col-md-3 col-xs-12">
            <div class="bg-primary text-white p-3">There are {{ $carts->count() > 0 ? $carts->count() . ' item in your cart' : 'no item in your cart' }}</div>
            <div class="block-list mt-0">
                <ul class="p-3">
                    @if ($carts->isNotEmpty())
                        <li>
                            Total products:
                            <span class="float-right">{{ currency(
                                $carts->sum(function ($cart) {
                                    return ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price'];
                                }),
                            ) }}</span>
                        </li>
                    @endif
                </ul>
            </div>

            <div>
                @if ($carts->isEmpty())
                    <a href="{{ route('home') }}" class="continue btn btn-primary btn-block">{{ __('Continue Shopping') }}</a>
                @else
                    <a href="{{ route('checkout') }}" class="continue btn btn-primary btn-block">{{ __('Order') }}</a>
                @endif
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
</div>
