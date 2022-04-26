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

                        @foreach ($order->spice_data as $spice)
                            <div class="row my-4">
                                <div class="col-md-1">
                                    <span class="product-image media-middle">
                                        <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice->nama)]) }}">
                                            <img class="img-fluid" src="{{ asset('/storage/images/product/' . $spice->image) }}">
                                        </a>
                                    </span>
                                </div>
                                <div class="col-md-11 d-flex flex-column">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h6 class="product-name">
                                                <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice->nama)]) }}">{{ $spice->nama }}</a>
                                            </h6>
                                            <div class="product-meta">
                                                <span class="product-price">{{ $spice->jumlah }} x {{ currency($spice->hrg_jual) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="border-left pl-3">
                                                <div>Total</div>
                                                <div>{{ currency($spice->hrg_jual * $spice->jumlah) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="w-100">
                            <div class="ml-auto mt-auto w-fit" wire:ignore>
                                @if ($order->need_rate == 0)
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
                            <h5 class="product-name">{{ $detailOrder ? $detailOrder->spice_data->nama : '' }}</h5>
                            <div class="product-price">{{ $detailOrder ? currency($detailOrder->spice_data->hrg_jual) : 0 }} <small>({{ $detailOrder ? $detailOrder->spice_data->unit : '' }})</small></div>
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

    <x-jet-dialog-modal wire:model="detailModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ 'Order Status' }}
        </x-slot>

        <x-slot name="close">
            <button type="button" class="close" aria-label="Close" wire:click="$set('detailModal', false)">
                <i class="fas fa-times"></i>
            </button>
        </x-slot>

        <x-slot name="content">
            <div class="card">
                <div class="card-body row">
                    <div class="col">
                        <strong>Purchase date:</strong>
                        <br>{{ $detailOrder ? $detailOrder->created_at->format('M d, Y - H:m:s') : '' }}
                    </div>
                    <div class="col">
                        <strong>Status:</strong>
                        <br>{{ $detailOrder ? $detailOrder->statuses_nama : '' }}
                    </div>
                    <div class="col">
                        <strong>Invoice :</strong>
                        <br>{{ $detailOrder ? $detailOrder->invoice : '' }}
                    </div>
                </div>
            </div>
            <div class="track">
                @foreach ($traceOrder as $trace)
                    <div class="step active">
                        <span class="icon"><i class="{{ $trace->icon }}"></i></span>
                        <span class="text">{{ $trace->nama }}</span>
                    </div>
                @endforeach
            </div>
            <div class="row pb-0">
                <div class="col-6">
                    <hr>
                    <h6>{{ __('Product Details') }}</h6>
                    <hr>
                </div>
                <div class="col-6">
                    <hr>
                    <h6>{{ __('Shipping Info') }}</h6>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="product-image img-fluid" src="{{ $detailOrder ? asset('/storage/images/product/' . $detailOrder->spice_data->image) : '' }}">
                                    </div>
                                    <div class="col-8 row">
                                        <div class="col-6">
                                            <div class="mb-2 font-weight-bold">Product Name</div>
                                            <div class="mb-2 font-weight-bold">Product Price</div>
                                            <div class="mb-2 font-weight-bold">Units</div>
                                            <div class="mb-2 font-weight-bold">Quantity</div>
                                            <div class="mb-2 font-weight-bold">Total Price</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">{{ $detailOrder ? $detailOrder->spice_data->nama : '' }}</div>
                                            <div class="mb-2">{{ $detailOrder ? currency($detailOrder->spice_data->hrg_jual) : 0 }}</div>
                                            <div class="mb-2">{{ $detailOrder ? $detailOrder->spice_data->unit : '' }}</div>
                                            <div class="mb-2">{{ $detailOrder ? $detailOrder->jumlah : 0 }}</div>
                                            <div class="mb-2">{{ $detailOrder ? currency($detailOrder->spice_data->hrg_jual * $detailOrder->jumlah) : 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-2 font-weight-bold">Product Name</div>
                                        <div class="mb-2 font-weight-bold">Product Price</div>
                                        <div class="mb-2 font-weight-bold">Units</div>
                                        <div class="mb-2 font-weight-bold">Quantity</div>
                                        <div class="mb-2 font-weight-bold">Total Price</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">{{ $detailOrder ? $detailOrder->spice_data->nama : '' }}</div>
                                        <div class="mb-2">{{ $detailOrder ? currency($detailOrder->spice_data->hrg_jual) : 0 }}</div>
                                        <div class="mb-2">{{ $detailOrder ? $detailOrder->spice_data->unit : '' }}</div>
                                        <div class="mb-2">{{ $detailOrder ? $detailOrder->jumlah : 0 }}</div>
                                        <div class="mb-2">{{ $detailOrder ? currency($detailOrder->spice_data->hrg_jual * $detailOrder->jumlah) : 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </x-slot>
    </x-jet-dialog-modal>

</div>
