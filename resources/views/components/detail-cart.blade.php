@props(['id' => null, 'maxWidth' => null, 'modal' => []])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes->merge(['class' => 'quickview in']) }}>
    <div class="modal-content content">
        <div class="modal-header">
            <button type="button" class="close" aria-label="Close" wire:click="$set('detailModal', false)">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row no-gutters">
                @if (count($modal) > 0)
                    <div class="col-md-5 col-sm-5 divide-right d-flex align-items-center">
                        <div class="images-container bottom_thumb">
                            <div class="product-cover">
                                <img class="img-fluid" src="{{ $modal['image'] }}" style="width:100%;">
                            </div>
                        </div>
                    </div>
                    <div class="product-info col-md-7 col-sm-7 pl-4">
                        <h1 class="product-name">{{ $modal['name'] }}</h1>
                        <span class="float-right">
                            <span>Availability : </span>
                            <span class="check {{ $modal['instock'] ? 'availb' : 'sold' }}">
                                <i class="fas {{ $modal['instock'] ? 'fa-check-square' : 'fa-times' }}"></i> {{ $modal['instock'] ? 'IN STOCK' : 'SOLD OUT' }}
                            </span>
                        </span>
                        <div class="rating mb-2">
                            <div class="star-content">
                                @for ($i = 0; $i < 5; $i++)
                                    <div class="star{{ $i < $modal['rating'] ? '' : ' hole' }}"></div>
                                @endfor
                            </div>
                            <small>({{ round($modal['rating'], 1) }})</small>
                        </div>

                        <div class="product-prices">
                            <div class="product-price">
                                <div class="current-price">
                                    <span>{{ currency($modal['price']) }} <small>({{ $modal['unit'] }})</small></span>
                                </div>
                            </div>
                        </div>

                        <div class="product-description-short">
                            <p>{{ $modal['desc'] }}</p>
                        </div>

                        <div class="detail-description">
                            <div class="option has-border d-flex align-items-center">
                                <span>{{ currency($modal['price']) }} x {{ $modal['qty'] }} :</span>
                                <span class="price ml-3">{{ currency($modal['price'] * $modal['qty']) }}</span>
                            </div>
                            <div class="has-border cart-area">
                                <div class="product-quantity">
                                    <div class="qty">
                                        <div class="input-group">
                                            <div class="quantity">
                                                <span class="control-label">QTY : </span>
                                                <input min="1" type="number" wire:model="modal.qty" class="input-group form-control" oninput="if(this.value == '') {this.value = 0}">
                                            </div>
                                            <span class="add">
                                                <button class="btn btn-primary add-to-cart add-item {{ $modal['instock'] ? '' : 'disabled' }}" type="submit" wire:click="addToCart">
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
                @endif
            </div>
        </div>
    </div>
</x-modal>
