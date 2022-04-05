<div class="myaccount-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Orders List') }}</h1>
    </div>

    @if ($orders->count() < 1)
        <p class="saved-message">{{ __('Your Orders List is Empty') }}</p>
    @endif

    <div class="row">
        @foreach ($orders as $order)
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body pt-2">

                        <div class="mb-4 d-flex">
                            <div class="mr-auto">
                                <small class="text-uppercase">Invoice : </small>
                                <small>{{ $order->invoice }}</small>
                            </div>
                            <div class="ml-auto">
                                <small>{{ $order->created_at->diffForHumans() }}</small>
                                <span class="mx-2">|</span>
                                <small class="text-uppercase" wire:ignore>{{ $order->statuses_nama }}</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <span class="product-image media-middle">
                                    <a href="{{ route('detail', ['product' => str_replace(' ', '-', $order->spice_data->nama)]) }}">
                                        <img class="img-fluid" src="{{ asset('/storage/images/product/' . $order->spice_data->image) }}">
                                    </a>
                                </span>
                            </div>
                            <div class="col-md-10 d-flex flex-column">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h6 class="product-name">
                                            <a href="{{ route('detail', ['product' => str_replace(' ', '-', $order->spice_data->nama)]) }}">{{ $order->spice_data->nama }}</a>
                                        </h6>
                                        <div class="product-meta">
                                            <span class="product-price">{{ $order->jumlah }} x Rp. {{ number_format($order->spice_data->hrg_jual, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="border-left pl-3">
                                            <div>Total</div>
                                            <div>Rp. {{ number_format($order->spice_data->hrg_jual * $order->jumlah, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-auto mt-auto" wire:ignore>
                                    @if ($order->need_rate)
                                        <a role="button" wire:click="openModalReview('{{ $order->id }}')">
                                            <i class="fas fa-pen-square"></i>
                                            <span>{{ __('Write a Review') }}</span>
                                        </a>
                                        <span class="mx-2">|</span>
                                    @endif
                                    <a role="button" wire:click="openModalDetail('{{ $order->id }}')">
                                        <i class="fas fa-receipt"></i>
                                        <span>{{ __('Details') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <x-jet-dialog-modal wire:model="reviewModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ __('Leave a Review') }}
        </x-slot>

        <x-slot name="content">
            <div class="row p-0">
                <div class="col-md-3 divide-right">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <img class="product-image img-fluid" src="{{ $detailOrder ? asset('/storage/images/product/' . $detailOrder->spice_data->image) : '' }}">
                        </div>
                        <div class="col-md-12">
                            <div class="h5 product-name">{{ $detailOrder ? $detailOrder->spice_data->nama : '' }}</div>
                            <div class="product-price">Rp. {{ $detailOrder ? number_format($detailOrder->spice_data->hrg_jual, 0, ',', '.') : 0 }} <small>({{ $detailOrder ? $detailOrder->spice_data->unit : '' }})</small></div>
                            <p>Quantity:&nbsp;{{ $detailOrder ? $detailOrder->jumlah : 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="cart-content review p-0">
                        <div class="spr-form-review-rating">
                            <label class="spr-form-label">Your Rating</label>
                            <div class="d-flex justify-content-center">
                                <fieldset class="ratings">
                                    <input type="radio" id="star5" wire:model.defer="rating.1" value="5">
                                    <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4" wire:model.defer="rating.2" value="4">
                                    <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3" wire:model.defer="rating.3" value="3">
                                    <label class="full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2" wire:model.defer="rating.4" value="2">
                                    <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1" wire:model.defer="rating.5" value="1">
                                    <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="spr-form-review-body">
                            <div class="spr-form-input">
                                <x-jet-label for="review" value="{{ __('Write a Review') }}" />
                                <textarea id="review" type="text" class="{{ $errors->has('review') ? 'is-invalid' : '' }} form-control form-control-user rounded-sm" wire:model.defer="review"></textarea>
                                <x-jet-input-error for="review" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('reviewModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="submitReview">
                <span wire:loading wire:target="submitReview" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Submit Review') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="detailModal" :maxWidth="'xl'">
        <x-slot name="title">
            {{ __('Order Details') }}
        </x-slot>

        <x-slot name="content">
            <h6>Order ID: OD45345345435</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i> +1598675986 </div>
                    <div class="col"> <strong>Status:</strong> <br> Picked by the courier </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                </div>
            </article>
            <div class="track">
                @foreach ($statuses as $status)
                    <div class="step active">
                        <span class="icon"><i class="{{ $status->icon }}"></i></span>
                        <span class="text">{{ $status->nama }}</span>
                    </div>
                @endforeach
            </div>
            <hr>
            <ul class="row">
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="https://i.imgur.com/iDwDQ4o.png" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">Dell Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$950 </span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="https://i.imgur.com/tVBy5Q0.png" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">HP Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$850 </span>
                        </figcaption>
                    </figure>
                </li>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="https://i.imgur.com/Bd56jKH.png" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">ACER Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$650 </span>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </x-slot>
    </x-jet-dialog-modal>

</div>
