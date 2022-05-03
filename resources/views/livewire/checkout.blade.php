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
                @livewire('address')
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
                            <x-jet-input id="name" type="text" class="{{ $errors->has('payment.name') ? 'is-invalid' : '' }}" wire:model="payment.name" maxlength="20" :disabled="$postage == null" />
                            <x-jet-input-error for="payment.name" />
                        </div>

                        <div class="my-1 col-md-12">
                            <x-jet-label class="small mb-1" for="cardnumber" value="{{ __('Card Number') }}" />
                            <x-jet-input id="cardnumber" type="text" class="{{ $errors->has('payment.cardnumber') ? 'is-invalid' : '' }}" wire:model="payment.cardnumber" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="$postage == null" />
                            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" wire:ignore>
                            </svg>
                            <x-jet-input-error for="payment.cardnumber" />
                        </div>

                        <div class="my-1 col-md-7">
                            <x-jet-label class="small mb-1" for="expirationdate" value="{{ __('Expiration (mm/yy)') }}" />
                            <x-jet-input id="expirationdate" type="text" class="{{ $errors->has('payment.expirationdate') ? 'is-invalid' : '' }}" wire:model="payment.expirationdate" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="$postage == null" />
                            <x-jet-input-error for="payment.expirationdate" />
                        </div>

                        <div class="my-1 col-md-5">
                            <x-jet-label class="small mb-1" for="securitycode" value="{{ __('Security Code') }}" />
                            <x-jet-input id="securitycode" type="text" class="{{ $errors->has('payment.securitycode') ? 'is-invalid' : '' }}" wire:model="payment.securitycode" maxlength="20" pattern="[0-9]*" inputmode="numeric" :disabled="$postage == null" />
                            <x-jet-input-error for="payment.securitycode" />
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

            <x-jet-button class="w-100 d-flex align-items-center justify-content-center continue{{ $postage == null ? ' disabled' : '' }}" wire:loading.attr="disabled" wire:click="getToken">
                <span wire:loading wire:target="getToken" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Place Order') }}
            </x-jet-button>
        </div>
    </div>

    <x-feedback-modal wire:model="warningModal" :maxWidth="'lg'" :icon="'fas fa-times'">
        <x-slot name="title">
            {{ $head_message }}
        </x-slot>

        <x-slot name="content">
            <ul class="list-group list-group-flush">
                <li class="list-group-item pl-0"><i>{{ $status_message }}</i></li>
                @foreach ($validation_messages as $messages)
                    <li class="list-group-item pl-0"><i>{{ $messages }}</i></li>
                @endforeach
            </ul>
        </x-slot>
    </x-feedback-modal>
</div>
