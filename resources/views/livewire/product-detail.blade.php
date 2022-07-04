<div class="page-home">

    <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => $this->maggot->nama, 'url' => route('detail', ['product' => str_replace(' ', '-', $this->maggot->nama)])]]" />

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-sm-5 mb-5">
                    <div class="images-container">

                        <div class="js-qv-mask mask tab-content border">
                            @foreach ($maggot_image as $key => $image)
                                <div id="item-{{ $key }}" class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" role="tabpanel">
                                    <img src="{{ asset("storage/images/products/$image->image") }}">
                                </div>
                            @endforeach
                            <div class="layer-right-bottom" data-toggle="modal" data-target="#product-modal">
                                <i class="fa fa-expand"></i>
                            </div>
                        </div>
                        <ul class="product-tab nav nav-tabs d-flex" role="tablist">
                            @foreach ($maggot_image as $key => $image)
                                <li class="col {{ $key == 0 ? 'active' : '' }}">
                                    <a href="#item-{{ $key }}" data-toggle="tab" class="{{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset("storage/images/products/$image->image") }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="modal fade" id="product-modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-body">
                                            <div class="product-detail">
                                                <div class="images-container">
                                                    <div class="js-qv-mask mask tab-content w-100">
                                                        @foreach ($maggot_image as $key => $image)
                                                            <div id="modal-item-{{ $key }}" class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" role="tabpanel">
                                                                <img src="{{ asset("storage/images/products/$image->image") }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <ul class="product-tab mt-0 nav nav-tabs">
                                                        @foreach ($maggot_image as $key => $image)
                                                            <li class="{{ $key == 0 ? 'active' : '' }}">
                                                                <a href="#modal-item-{{ $key }}" data-toggle="tab" class="{{ $key == 0 ? 'active' : '' }}">
                                                                    <img src="{{ asset("storage/images/products/$image->image") }}">
                                                                </a>
                                                            </li>
                                                        @endforeach
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

                <div class="product-info col-xs-12 col-md-7 col-sm-7">
                    <div class="detail-description">
                        <div class="mb-5">
                            <h2>{{ $this->maggot->nama }}</h2>
                        </div>
                        <div>
                            <span class="price">{{ currency($maggot->hrg_jual) }}</span>
                            <span class="float-right">
                                <span class="availb">Availability: </span>
                                <span class="check {{ $maggot->stok > 0 ? 'availb' : 'sold' }}">
                                    <i class="fas {{ $maggot->stok > 0 ? 'fa-check-square' : 'fa-times' }}"></i> {{ $maggot->stok > 0 ? 'IN STOCK' : 'SOLD OUT' }}
                                </span>
                            </span>
                        </div>
                        <p class="description">{{ $maggot->ket }}</p>
                        <div class="option has-border d-lg-flex">
                            <span>Unit :</span>
                            <span>{{ $maggot->unit }}</span>
                        </div>
                        <div class="rating-comment has-border d-flex">
                            <div class="review-description d-flex">
                                <span>REVIEW :</span>
                                <div class="rating" wire:ignore>
                                    <div class="star-content">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="star{{ $i < $maggot->rating_avg ? '' : ' hole' }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <small>({{ round($maggot->rating_avg, 1) }})</small>
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
                            <span>{{ $maggot->stok }} ({{ $maggot->unit }})</span>
                        </div>
                        <div class="option has-border d-flex align-items-center">
                            <span>{{ currency($maggot->hrg_jual) }} x {{ $qty }} :</span>
                            <span class="price ml-3">{{ currency($maggot->hrg_jual * $qty) }}</span>
                        </div>
                        <div class="has-border cart-area {{ $errors->has('qty') ? 'is-invalid' : '' }}">
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
                        <x-jet-input-error for="qty" />
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
                    @livewire('product-exhibition', ['maggots' => $maggots])
                </div>
            </div>
        </div>
    </div>

    <x-feedback-cart wire:model="feedbackDetailModal" :maxWidth="'lg'" :modal="$modal" />

    <x-feedback-modal wire:model="warningDetailModal" :maxWidth="'sm'" :icon="'fas fa-times'">
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
