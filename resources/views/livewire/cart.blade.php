<div class="cart-grid">
    <h1 class="title-page">{{ __('Shopping Cart') }}</h1>
    <div class="row">
        <div class="cart-container col-md-9 col-xs-12">
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
                                <div class="product-line-grid-body col-md-5 d-flex">
                                    <div class="align-self-center">
                                        <div class="product-line-info">
                                            <a class="label" href="{{ $cart['url'] }}">{{ $cart['name'] }}</a>
                                        </div>
                                        <div class="product-line-info product-price">
                                            <span class="value">{{ currency($cart['price']) }}</span>
                                        </div>
                                        <div class="product-line-info">
                                            <span class="label-atrr">Unit:</span>
                                            <span class="value">{{ $cart['unit'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-line-grid-right text-center product-line-actions col-md-5 d-flex">
                                    <div class="row align-self-center">
                                        <div class="col-md-4 col">
                                            <div class="label w-100">Qty:</div>
                                            <div class="quantity w-100">
                                                <input min="1" type="number" wire:model="carts.{{ $key }}.qty" class="input-group form-control {{ $cart['qty'] != '' && $cart['qty'] > 999 ? 'px-2' : 'pr-2' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col">
                                            <div class="label">Total:</div>
                                            <div class="product-price total">{{ currency($cart['price'] * ($cart['qty'] == '' ? 0 : $cart['qty'])) }}</div>
                                        </div>
                                        <div class="col-md-2 col text-xs-right">
                                            <div class="cart-line-product-actions ">
                                                <button class="btn p-0 remove-from-cart" wire:click="deleteCart('{{ $cart['id'] }}')">
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
                    <a href="{{ route('checkout') }}" class="continue btn btn-primary btn-block">{{ __('Proceed To Checkout') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
