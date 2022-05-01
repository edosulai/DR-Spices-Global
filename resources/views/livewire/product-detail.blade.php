<div class="page-home">

    <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => $this->spice->nama, 'url' => route('detail', ['product' => str_replace(' ', '-', $this->spice->nama)])]]" />

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col">
                    <div class="product-single row">
                        <div class="product-detail col-xs-12 col-md-5 col-sm-5">
                            <div class="page-content">
                                <div class="images-container">
                                    <div class="js-qv-mask mask tab-content border">
                                        <div id="item1" class="tab-pane fade active in show">
                                            <img src="{{ asset("storage/images/product/$spice->image") }}" alt="img">
                                        </div>
                                        <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                            <i class="fa fa-expand"></i>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="product-modal" role="dialog">
                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-body">
                                                        <div class="product-detail">
                                                            <div>
                                                                <div class="images-container">
                                                                    <div class="js-qv-mask mask tab-content">
                                                                        <div id="modal-item1" class="tab-pane fade active in show">
                                                                            <img src="{{ asset("storage/images/product/$spice->image") }}" alt="img">
                                                                        </div>
                                                                    </div>
                                                                    <ul class="product-tab nav nav-tabs">
                                                                        <li class="active">
                                                                            <a href="#modal-item1" data-toggle="tab" class=" active show">
                                                                                <img src="{{ asset("storage/images/product/$spice->image") }}" alt="img">
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-info col-xs-12 col-md-7 col-sm-7">
                            <div class="detail-description">
                                <div class="mb-5">
                                    <h2>{{ $this->spice->nama }}</h2>
                                </div>
                                <div>
                                    <span class="price">{{ currency($spice->hrg_jual) }}</span>
                                    <span class="float-right">
                                        <span class="availb">Availability: </span>
                                        <span class="check {{ $spice->stok > 0 ? 'availb' : 'sold' }}">
                                            <i class="fas {{ $spice->stok > 0 ? 'fa-check-square' : 'fa-times' }}"></i> {{ $spice->stok > 0 ? 'IN STOCK' : 'SOLD OUT' }}
                                        </span>
                                    </span>
                                </div>
                                <p class="description">{{ $spice->ket }}</p>
                                <div class="option has-border d-lg-flex">
                                    <span>Unit :</span>
                                    <span>{{ $spice->unit }}</span>
                                </div>
                                <div class="rating-comment has-border d-flex">
                                    <div class="review-description d-flex">
                                        <span>REVIEW :</span>
                                        <div class="rating" wire:ignore>
                                            <div class="star-content">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <div class="star{{ $i < $spice->rating_avg ? '' : ' hole' }}">
                                                    </div>
                                                @endfor
                                            </div>
                                            <small>({{ round($spice->rating_avg, 1) }})</small>
                                        </div>
                                    </div>
                                    <div class="read after-has-border">
                                        <a href="#review">
                                            <i class="fa fa-commenting-o color" aria-hidden="true"></i>
                                            <span>READ REVIEWS ({{ $reviews->count() }})</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="option has-border d-lg-flex">
                                    <span>Stok :</span>
                                    <span>{{ $spice->stok }} ({{ $spice->unit }})</span>
                                </div>
                                <div class="option has-border d-flex align-items-center">
                                    <span>{{ currency($spice->hrg_jual) }} x {{ $qty }} :</span>
                                    <span class="price ml-3">{{ currency($spice->hrg_jual * $qty) }}</span>
                                </div>
                                <div class="has-border cart-area">
                                    <div class="product-quantity">
                                        <div class="qty">
                                            <div class="input-group">
                                                <div class="quantity">
                                                    <span class="control-label">QTY : </span>
                                                    <input min="1" type="number" wire:model="qty" class="input-group form-control" oninput="if(this.value == '') {this.value = 0}">
                                                </div>
                                                <span class="add">
                                                    <button class="btn btn-primary add-to-cart add-item" wire:click="addToCart">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                        <span>Add to cart</span>
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

                    <div class="review">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#review" class="active show">Reviews ({{ $reviews->count() }})</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="review" class="tab-pane fade in active show">
                                <div class="spr-form">
                                    <div class="user-comment">
                                        @foreach ($reviews as $review)
                                            <div class="spr-review">
                                                <div class="spr-review-header">
                                                    <span class="spr-review-header-byline">
                                                        <strong>{{ $review->users_name }}</strong> -
                                                        <span>{{ Illuminate\Support\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
                                                    </span>
                                                    <div class="rating">
                                                        <div class="star-content">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <div class="star{{ $i < $review->rating ? '' : ' hole' }}">
                                                                </div>
                                                            @endfor
                                                        </div>
                                                        <small>({{ $review->rating }})</small>
                                                    </div>
                                                </div>
                                                <div class="spr-review-content">
                                                    <p class="spr-review-content-body">{{ $review->summary }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{ $reviews->links() }}
                        </div>

                        <div class="related">
                            <div class="title-tab-content  text-center">
                                <div class="title-product justify-content-start">
                                    <h2>{{ __('Other Products') }}</h2>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade in active show">
                                    <div class="category-product owl-carousel" wire:ignore>

                                        @foreach ($spices as $spic)
                                            <div class="item text-center">
                                                <div class="product-miniature js-product-miniature item-one first-item">
                                                    <div class="thumbnail-container border border">
                                                        <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spic->nama)]) }}">
                                                            <img class="img-fluid" src="{{ asset("storage/images/product/$spic->image") }}" alt="img">
                                                        </a>
                                                        {{-- <div class="product-flags discount">-30%</div> --}}
                                                    </div>
                                                    <div class="product-description">
                                                        <div class="product-groups">
                                                            <div class="product-title">
                                                                <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spic->nama)]) }}">{{ $spic->nama }}</a>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="star-content">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        <div class="star{{ $i < $spic->rating_avg ? '' : ' hole' }}">
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="product-group-price">
                                                                <div class="product-price-and-shipping">
                                                                    <span class="price">{{ currency($spic->hrg_jual) }} <small>({{ $spic->unit }})</small></span>
                                                                    {{-- <del class="regular-price">£28.68</del> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-buttons d-flex justify-content-center">
                                                            <button type="button" class="add-to-cart" wire:click="addToCart('{{ $spic->id }}')">
                                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                            </button>

                                                            <button type="button" class="quick-view hidden-sm-down" wire:click="detailSpice('{{ $spic->id }}')">
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
        </div>
    </div>

    <x-feedback-cart wire:model="feedbackCartAddModal" :maxWidth="'lg'" :modal="$modal" />
    <x-detail-cart wire:model="detailModal" :maxWidth="'lg'" :modal="$modal" />

    <x-feedback-modal wire:model="warningModal" :maxWidth="'sm'" :icon="'fas fa-times'">
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
