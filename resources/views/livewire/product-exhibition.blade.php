<div class="section product-living-room">
    <div class="container">
        <div class="row">
            <div class="new-arrivals product-tab col">
                <div class="tab-content">
                    <div class="title-tab-content product-tab justify-content-between">
                        <div class="title-product">
                            <h2>{{ __('Our Product') }}</h2>
                            <p>{{ __('LOREM IPSUM DOLOR SIT AMET CONSECTETUR') }}</p>
                        </div>
                        {{-- <ul class="nav nav-tabs">
                            <li>
                                <a href="#new" class="active" data-toggle="tab">New Arrivals</a>
                            </li>
                            <li>
                                <a href="#best" data-toggle="tab">Best Seller</a>
                            </li>
                            <li>
                                <a href="#sale" data-toggle="tab">Featured Product</a>
                            </li>
                        </ul> --}}
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active show">
                            <div class="category-product owl-carousel owl-theme owl-loaded owl-drag" wire:ignore>
                                @foreach ($spices as $spice)
                                <div class="item text-center">
                                    <div class="product-miniature js-product-miniature item-one first-item">
                                        <div class="thumbnail-container">
                                            <a href="{{ url(str_replace(' ', '-', $spice->nama)) }}">
                                                <img class="img-fluid" src="{{ asset("storage/images/product/$spice->image") }}" alt="img">
                                            </a>
                                            {{-- <div class="product-flags discount">-30%</div> --}}
                                        </div>
                                        <div class="product-description">
                                            <div class="product-groups">
                                                <div class="product-title">
                                                    <a href="{{ url(str_replace(' ', '-', $spice->nama)) }}">{{ $spice->nama }}</a>
                                                </div>
                                                {{-- <div class="rating">
                                                    <div class="star-content">
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                        <div class="star"></div>
                                                    </div>
                                                </div> --}}
                                                <div class="product-group-price">
                                                    <div class="product-price-and-shipping">
                                                        <span class="price">Rp. {{ number_format($spice->hrg_jual, 0, ',', '.') }}</span>
                                                        {{-- <del class="regular-price">£28.68</del> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-buttons d-flex justify-content-center">
                                                <button type="button" class="add-to-cart" wire:click="addToCart({{$spice->id}})">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </button>

                                                <button type="button" class="quick-view hidden-sm-down">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal wire:model="feedbackCartAddModal" :maxWidth="'lg'" class="blockcart-modal in">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title text-xs-center" id="myModalLabel"><i class="fa fa-check"></i>Product successfully added to your shopping cart</h4>
                <button type="button" class="close" aria-label="Close" wire:click="$set('feedbackCartAddModal', false)">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 divide-right">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <img class="product-image img-fluid" src="{{ asset('/storage/images/product/'. $modalCartAddImage) }}" itemprop="image">
                            </div>
                            <div class="col-md-7">
                                <div class="h5 product-name">{{ $modalCartAddName }}</div>
                                <div class="product-price">Rp. {{ $modalCartAddPrice ? number_format($modalCartAddPrice, 0, ',', '.') : 0 }}</div>
                                <p>Quantity:&nbsp;{{ $modalCartAddQty }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-content">
                            <p class="cart-products-count">There are {{ $modalCartAddCount }} items in your cart.</p>
                            <p>Total products:&nbsp;Rp. {{ $modalCartAddTotal ? number_format($modalCartAddTotal, 0, ',', '.') : 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click="$set('feedbackCartAddModal', false)">Continue shopping</button>
                <a href="{{ route('checkout') }}" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i>Proceed to checkout</a>
            </div>
        </div>
    </x-modal>

</div>