<div class="section product-living-room">
    <div class="container">
        <div class="row">
            <div class="new-arrivals product-tab col">
                <div class="tab-content" id="product-exhibition">
                    <div class="title-tab-content product-tab justify-content-between">
                        <div class="title-product">
                            <h2>{{ __('Our Product') }}</h2>
                            <p>{{ __('LOREM IPSUM DOLOR SIT AMET CONSECTETUR') }}</p>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active show">
                            <div class="category-product owl-carousel" wire:ignore>
                                @foreach ($spices as $spice)
                                <div class="item text-center">
                                    <div class="product-miniature item-one first-item">
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
                                                <div class="rating">
                                                    <div class="star-content">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <div class="star{{ $i < $spice->review_avg ? '' : ' hole'}}"></div>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="product-group-price">
                                                    <div class="product-price-and-shipping">
                                                        <span class="price">Rp. {{ number_format($spice->hrg_jual, 0, ',', '.') }} <small>({{ $spice->unit }})</small></span>
                                                        {{-- <del class="regular-price">£28.68</del> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-buttons d-flex justify-content-center">
                                                <button type="button" class="add-to-cart" wire:click="addToCart({{$spice->id}})">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </button>

                                                <button type="button" class="quick-view hidden-sm-down" wire:click="detailSpice({{$spice->id}})">
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

    <x-modal wire:model="feedbackCartAddModal" :maxWidth="'lg'" class="blockcart in">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title text-xs-center" id="myModalLabel"><i class="fa fa-check"></i>{{ __('Product successfully added to your shopping cart') }}</h4>
                <button type="button" class="close" aria-label="Close" wire:click="$set('feedbackCartAddModal', false)">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">    
                <div class="row">
                    <div class="col-md-6 divide-right">
                        <div class="row no-gutters">
                            <div class="col-md-5">
                                <img class="product-image img-fluid" src="{{ $modalSpiceImage }}">
                            </div>
                            <div class="col-md-7">
                                <div class="h5 product-name">{{ $modalSpiceName }}</div>
                                <div class="product-price">Rp. {{ $modalSpicePrice ? number_format($modalSpicePrice, 0, ',', '.') : 0 }} <small>({{ $modalSpiceUnit }})</small></div>
                                <p>Quantity:&nbsp;{{ $modalSpiceQty }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-content">
                            <p class="cart-products-count">There are {{ $modalSpiceCount }} items in your cart.</p>
                            <p>Total products:&nbsp;Rp. {{ $modalSpiceTotal ? number_format($modalSpiceTotal, 0, ',', '.') : 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click="$set('feedbackCartAddModal', false)">{{ __('Continue shopping') }}</button>
                <a href="{{ route('checkout') }}" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i>{{ __('Proceed to checkout') }}</a>
            </div>
        </div>
    </x-modal>

    <x-modal wire:model="detailModal" :maxWidth="'lg'" class="quickview in">
        <div class="modal-content content">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" wire:click="$set('detailModal', false)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters main-product-detail">
                    <div class="col-md-5 col-sm-5 divide-right">
                        <div class="images-container bottom_thumb">
                            <div class="product-cover">
                                <img class="img-fluid" src="{{ $modalSpiceImage }}" style="width:100%;">
                                <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                    <i class="fa fa-expand"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info col-md-7 col-sm-7">
                        <h1 class="product-name">{{ $modalSpiceName }}</h1>
                        <span class="float-right">
                            <span>Availability : </span>
                            <span class="check {{ $modalSpiceInStock ? 'availb' : 'sold'}}">
                                <i class="fas {{ $modalSpiceInStock ? 'fa-check-square' : 'fa-times'}}"></i> {{ $modalSpiceInStock ? 'IN STOCK' : 'SOLD OUT'}}
                            </span>
                        </span>
                        <div class="rating mb-2">
                            <div class="star-content">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="star{{ $i < $modalSpiceRating ? '' : ' hole'}}"></div>
                                @endfor
                            </div>
                            <small>({{ round($modalSpiceRating, 1) }})</small>
                        </div>

                        <div class="product-prices">
                            <div class="product-price">
                                <div class="current-price">
                                    <span>Rp. {{ $modalSpicePrice ? number_format($modalSpicePrice, 0, ',', '.') : 0 }} <small>({{ $modalSpiceUnit }})</small></span>
                                </div>
                            </div>
                        </div>

                        <div id="product-description-short">
                            <p>{{ $modalSpiceDesc }}</p>
                        </div>

                        <div class="detail-description">
                            <div class="has-border cart-area">
                                <div class="product-quantity">
                                    <div class="qty">
                                        <div class="input-group">
                                            <div class="quantity">
                                                <span class="control-label">QTY : </span>
                                                <input min="1" type="number" wire:model="modalSpiceQty" class="input-group form-control">
                                            </div>
                                            <span class="add">
                                                <button class="btn btn-primary add-to-cart add-item {{ $modalSpiceInStock ? '' : 'disabled'}}" type="submit" wire:click="addToCart">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span>{{ __('Add to cart') }}</span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <p class="product-minimal-quantity">
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-modal>

</div>