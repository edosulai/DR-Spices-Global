<div class="main">
    <div class="row">
        <div class="cart-container col-md-8 col-xs-12" id="checkoutForm">

            <div class="checkout-personal-step">
                {{-- <h3 class="step-title h3 info" id="headingAddress"> --}}
                <h3 class="step-title h3 info">
                    {{-- <a role="button" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseAddress">
                        <span class="step-number">1</span>Shipping Address
                    </a> --}}
                    <span class="step-number">1</span>Shipping Address
                </h3>
            </div>
            {{-- <div id="collapseAddress" class="main-content collapse show" aria-labelledby="headingAddress" data-parent="#checkoutForm"> --}}
            <div class="main-content">
                @if (count($addresses) < 1)
                    <div class="mb-3">
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
                @endif

                <div class="row mb-3">
                    @foreach ($addresses as $address)
                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100{{ $address['primary'] ? ' border-dark' : '' }}">
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
                    @if (count($addresses) % 2 == 1)
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
            </div>

            <div class="checkout-personal-step">
                {{-- <h3 class="step-title h3 info" id="headingPayment"> --}}
                <h3 class="step-title h3 info">
                    {{-- <a role="button" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapsePayment" data-parent="#checkoutForm">
                        <span class="step-number">2</span>Payment Method
                    </a> --}}
                    <span class="step-number">2</span>Payment Method
                </h3>
            </div>
            {{-- <div id="collapsePayment" class="main-content collapse show" aria-labelledby="headingPayment" data-parent="#checkoutForm"> --}}
            <div class="main-content">
                <div class="row payment">
                    <div class="col-md-6 mb-5 d-none d-md-block" wire:ignore>
                        <x-credit-card />
                    </div>
                    <div class="col-md-6 row mb-5">
                        <div class="my-1 col-md-12">
                            <x-jet-label class="small mb-1" for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model="payment.name" maxlength="20" :disabled="count($addresses) < 1" />
                            <x-jet-input-error for="name" />
                        </div>

                        <div class="my-1 col-md-12">
                            <x-jet-label class="small mb-1" for="cardnumber" value="{{ __('Card Number') }}" />
                            <x-jet-input id="cardnumber" type="text" class="{{ $errors->has('cardnumber') ? 'is-invalid' : '' }}" wire:model="payment.cardnumber" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="count($addresses) < 1" />
                            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" wire:ignore>
                            </svg>
                            <x-jet-input-error for="cardnumber" />
                        </div>

                        <div class="my-1 col-md-7">
                            <x-jet-label class="small mb-1" for="expirationdate" value="{{ __('Expiration (mm/yy)') }}" />
                            <x-jet-input id="expirationdate" type="text" class="{{ $errors->has('expirationdate') ? 'is-invalid' : '' }}" wire:model="payment.expirationdate" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="count($addresses) < 1" />
                            <x-jet-input-error for="expirationdate" />
                        </div>

                        <div class="my-1 col-md-5">
                            <x-jet-label class="small mb-1" for="securitycode" value="{{ __('Security Code') }}" />
                            <x-jet-input id="securitycode" type="text" class="{{ $errors->has('securitycode') ? 'is-invalid' : '' }}" wire:model="payment.securitycode" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="count($addresses) < 1" />
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
                                <div class="col-md-2 pr-0 d-none d-md-block">
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
                        Shipping ({{ $carts->sum(fn($cart) => $cart['qty']) }} x {{ $postage ? currency($postage->cost) : 0 }}) :
                        <span class="float-right">{{ currency($carts->sum(fn($cart) => $cart['qty']) * ($postage ? $postage->cost : 0)) }}</span>
                    </li>
                    <li class="py-3">
                        Total products:
                        <span class="float-right">{{ currency(
                            $carts->sum(function ($cart) {
                                return ($cart['qty'] == '' ? 0 : $cart['qty']) * $cart['price'];
                            }) +
                                $carts->sum(fn($cart) => $cart['qty']) * ($postage ? $postage->cost : 0),
                        ) }}</span>
                    </li>
                </ul>
            </div>

            <div>
                <a role="button" wire:click="getToken" class="continue btn btn-primary btn-block{{ count($addresses) < 1 ? ' disabled' : '' }}">{{ __('Place Order') }}</a>
            </div>
        </div>
    </div>

    <x-query-address wire:model="queryAddressModal" :saveAction="'queryAddress'" :headTitle="$headerAddressModal" :countries="$countries" :modal="$modal" />
    <x-delete-address wire:model="deleteAddressModal" :deleteAction="'deleteAddress'" />

    <x-feedback-modal wire:model="warningModal" :maxWidth="'lg'">
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
    </x-feedback-modal>
</div>
