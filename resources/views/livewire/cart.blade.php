<div class="cart-grid row">
    <div class="col-md-9 col-xs-12 check-info">
        <h1 class="title-page">{{ __('Shopping Cart') }}</h1>
        <div class="cart-container">
            <div class="cart-overview">
                <ul class="cart-items">
                    @foreach ($carts as $key => $cart)
                    <li class="cart-item">
                        <div class="product-line-grid row justify-content-between">
                            <div class="product-line-grid-left col-md-2">
                                <span class="product-image media-middle">
                                    <a href="{{ $cart['url'] }}">
                                        <img class="img-fluid" src="{{ $cart['img_src'] }}" alt="{{ $cart['name'] }}">
                                    </a>
                                </span>
                            </div>
                            <div class="product-line-grid-body col-md-5">
                                <div class="product-line-info">
                                    <a class="label" href="{{ $cart['url'] }}">{{ $cart['name'] }}</a>
                                </div>
                                <div class="product-line-info product-price">
                                    <span class="value">Rp. {{ number_format($cart['price'], 0, ',', '.') }}</span>
                                </div>
                                <div class="product-line-info">
                                    <span class="label-atrr">Unit:</span>
                                    <span class="value">{{ $cart['unit'] }}</span>
                                </div>
                            </div>
                            <div class="product-line-grid-right text-center product-line-actions col-md-5">
                                <div class="row">
                                    <div class="col-md-4 col qty">
                                        <div class="label">Qty:</div>
                                        <div class="quantity">
                                            <input min="1" type="number" wire:model="carts.{{ $key }}.qty" class="input-group form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col price">
                                        <div class="label">Total:</div>
                                        <div class="product-price total">Rp. {{ number_format($cart['price'] * $cart['qty'], 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-md-2 col text-xs-right align-self-end">
                                        <div class="cart-line-product-actions ">
                                            <button class="btn p-0 remove-from-cart" wire:click="deleteCart('{{$cart['id']}}')">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @if ($carts->isEmpty())
                    <li class="cart-item">
                        <div class="product-line-grid row justify-content-between">
                            <div class="product-line-grid-body col-md-5">
                                There are no item in your cart
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        @if ($carts->isEmpty())
        <a href="{{ route('home') }}" class="continue btn btn-primary pull-xs-right">{{ __('Continue Shopping') }}</a>
        @else
        <a href="{{ route('checkout') }}" class="continue btn btn-primary pull-xs-right">{{ __('Proceed To Checkout') }}</a>
        @endif
    </div>
    <div class="cart-grid-right col-xs-12 col-lg-3">
        <div class="cart-summary">
            <div class="cart-detailed-totals">
                <div class="cart-summary-products">
                    <div class="summary-label">There are {{ $carts->count() > 0 ? $carts->count() . ' item in your cart' : 'no item in your cart' }} </div>
                </div>
                @if ($carts->isNotEmpty())
                <div class="cart-summary-line" id="cart-subtotal-products">
                    <span class="label">Total products:</span>
                    <span class="value">Rp. {{ number_format($carts->sum(function ($cart) {
                        return $cart['qty'] * $cart['price'];
                    }), 0, ',', '.') }}</span>
                </div>
                @endif
            </div>
        </div>
        <div id="block-reassurance">
            <ul>
                <li>
                    <div class="block-reassurance-item">
                        <img src="{{ asset('storage/images/product/check1.png') }}" alt="Security policy (edit with Customer reassurance module)">
                        <span>Security policy (edit with Customer reassurance module)</span>
                    </div>
                </li>
                <li>
                    <div class="block-reassurance-item">
                        <img src="{{ asset('storage/images/product/check2.png') }}" alt="Delivery policy (edit with Customer reassurance module)">
                        <span>Delivery policy (edit with Customer reassurance module)</span>
                    </div>
                </li>
                <li>
                    <div class="block-reassurance-item">
                        <img src="{{ asset('storage/images/product/check3.png') }}" alt="Return policy (edit with Customer reassurance module)">
                        <span>Return policy (edit with Customer reassurance module)</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>