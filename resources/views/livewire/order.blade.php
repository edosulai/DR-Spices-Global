<div class="myaccount-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Orders List') }}</h1>
    </div>

    @if ($orders->count() < 1)
        <p class="saved-message">{{ __('Your Orders List is Empty') }}</p>
    @endif

    <div class="row">
        @foreach ($orders->toArray()['data'] as $order)
            <div class="col-md-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body pt-2">
                        <div class="mb-4 d-flex">
                            <div class="mr-auto">
                                <small class="text-uppercase">Invoice : </small>
                                <small>{{ $order['invoice'] }}</small>
                            </div>
                            <div class="ml-auto">
                                <small>{{ Illuminate\Support\Carbon::parse($order['created_at'])->diffForHumans() }}</small>
                                <span class="mx-2">|</span>
                                <small class="text-uppercase">{{ $order['statuses_nama'] }}</small>
                            </div>
                        </div>

                        @foreach ($order['spice_data'] as $spice)
                            <div class="row my-4">
                                <div class="col-md-1">
                                    <span class="product-image media-middle">
                                        <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">
                                            <img class="img-fluid" src="{{ asset('/storage/images/product/' . $spice['image']) }}">
                                        </a>
                                    </span>
                                </div>
                                <div class="col-md-11 d-flex flex-column">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h6 class="product-name">
                                                <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">{{ $spice['nama'] }}</a>
                                            </h6>
                                            <div class="product-meta">
                                                <span class="product-price">{{ $spice['jumlah'] }} x {{ currency($spice['hrg_jual']) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="border-left pl-3">
                                                <div>Total</div>
                                                <div>{{ currency($spice['hrg_jual'] * $spice['jumlah']) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="w-100">
                            <div class="ml-auto mt-auto w-fit">
                                @if (in_array($order['statuses_nama'], ['Delivered', 'Rated']))
                                    <a role="button" wire:click="openModalReview('{{ $order['id'] }}')">
                                        <i class="fas fa-pen-square"></i>
                                        <span>{{ __('Write a Review') }}</span>
                                    </a>
                                    <span class="mx-2">|</span>
                                @endif
                                <a role="button" wire:click="openModalDetail('{{ $order['id'] }}')">
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

    {{ $orders->links() }}

    <x-jet-dialog-modal wire:model="reviewModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ __('Leave a Review') }}
        </x-slot>

        <x-slot name="content">
            @if ($detailOrder)
                @foreach ($detailOrder->spice_data as $spice)
                    <div class="row p-0">
                        <div class="col-md-3 divide-right">
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <img class="product-image img-fluid" src="{{ asset('/storage/images/product/' . $spice['image']) }}">
                                </div>
                                <div class="col-md-12">
                                    <h5 class="product-name">{{ $spice['nama'] }}</h5>
                                    <div class="product-price">{{ currency($spice['hrg_jual']) }} <small>({{ $spice['unit'] }})</small></div>
                                    <p>Quantity:&nbsp;{{ $spice['jumlah'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="cart-content review p-0">
                                <div class="spr-form-review-rating">
                                    <label class="spr-form-label">Your Rating</label>
                                    <div class="d-flex justify-content-center">
                                        <fieldset class="ratings">
                                            <input type="radio" id="star5-{{ $spice['id'] }}" name="rating-{{ $spice['id'] }}" wire:model.defer="ratings.{{ $spice['id'] }}" value="5">
                                            <label class="full" for="star5-{{ $spice['id'] }}" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4-{{ $spice['id'] }}" name="rating-{{ $spice['id'] }}" wire:model.defer="ratings.{{ $spice['id'] }}" value="4">
                                            <label class="full" for="star4-{{ $spice['id'] }}" title="Pretty Good - 4 stars"></label>
                                            <input type="radio" id="star3-{{ $spice['id'] }}" name="rating-{{ $spice['id'] }}" wire:model.defer="ratings.{{ $spice['id'] }}" value="3">
                                            <label class="full" for="star3-{{ $spice['id'] }}" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2-{{ $spice['id'] }}" name="rating-{{ $spice['id'] }}" wire:model.defer="ratings.{{ $spice['id'] }}" value="2">
                                            <label class="full" for="star2-{{ $spice['id'] }}" title="Kinda Bad - 2 stars"></label>
                                            <input type="radio" id="star1-{{ $spice['id'] }}" name="rating-{{ $spice['id'] }}" wire:model.defer="ratings.{{ $spice['id'] }}" value="1">
                                            <label class="full" for="star1-{{ $spice['id'] }}" title="Sucks Big Time - 1 star"></label>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="spr-form-review-body">
                                    <div class="spr-form-input">
                                        <x-jet-label for="review-{{ $spice['id'] }}" value="{{ __('Write a Review') }}" />
                                        <textarea id="review-{{ $spice['id'] }}" type="text" class="{{ $errors->has('review') ? 'is-invalid' : '' }} form-control form-control-user rounded-sm" wire:model.defer="reviews.{{ $spice['id'] }}"></textarea>
                                        <x-jet-input-error for="review-{{ $spice['id'] }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
            @if ($detailOrder)
                <div class="card">
                    <div class="card-body row">
                        <div class="col">
                            <strong>Purchase date:</strong>
                            <br>
                            <span>{{ $detailOrder->created_at->format('M d, Y - H:m:s') }}</span>
                        </div>
                        <div class="col">
                            <strong>Status:</strong>
                            <br>
                            <span>{{ $detailOrder->statuses_nama }}</span>
                        </div>
                        <div class="col">
                            <strong>Total Price :</strong>
                            <br>
                            <span>{{ currency($detailOrder->transaction_data['transaction_details']['gross_amount']) }}</span>
                        </div>
                        <div class="col">
                            <strong>Invoice :</strong>
                            <br>
                            <span>{{ $detailOrder->invoice }}</span>
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
                <div class="row py-0">
                    <div class="col-7">
                        <hr>
                        <h6>{{ __('Product Details') }}</h6>
                        <hr>
                    </div>
                    <div class="col-5">
                        <hr>
                        <h6>{{ __('Shipping Details') }}</h6>
                        <hr>
                    </div>
                </div>

                <div class="row py-0">
                    <div class="col-7">
                        {{-- <div class="row my-0 py-0 overflow-auto" style="height: 150px"> --}}
                        <div class="row my-0 py-0">
                            @foreach ($detailOrder->spice_data as $spice)
                                <div class="col-12">
                                    <div class="row my-0 py-0">
                                        <div class="col-md-2">
                                            <span class="product-image media-middle">
                                                <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">
                                                    <img class="img-fluid" src="{{ asset('/storage/images/product/' . $spice['image']) }}">
                                                </a>
                                            </span>
                                        </div>

                                        <div class="col-md-10 d-flex flex-column justify-content-center">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <h6 class="product-name">
                                                        <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">{{ $spice['nama'] }}</a>
                                                    </h6>
                                                    <div class="product-meta">
                                                        <span class="product-price">{{ $spice['jumlah'] }} x {{ currency($spice['hrg_jual']) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 d-flex align-items-center">
                                                    <div class="border-left pl-3">
                                                        <div>Total</div>
                                                        <div class="font-italic">{{ currency($spice['hrg_jual'] * $spice['jumlah']) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                </div>
                            @endforeach

                            <div class="col-12 mt-3">
                                <div class="row my-0 py-0">
                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="my-2">Produk Total</div>
                                                <div class="my-2">Shipping Cost / ({{$detailOrder->spice_data[0]['unit']}})</div>
                                                <div class="my-2">Total Shipping Cost x {{collect($detailOrder->spice_data)->sum('jumlah')}}</div>
                                                <h6 class="my-3">Total Price</h6>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency(
                                                    collect($detailOrder->spice_data)->sum(function ($spice) {
                                                        return $spice['hrg_jual'] * $spice['jumlah'];
                                                    }),
                                                ) }}</span></div>
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency($detailOrder->transaction_data['postage']['cost']) }}</span></div>
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency($detailOrder->transaction_data['postage']['cost'] * collect($detailOrder->spice_data)->sum('jumlah')) }}</span></div>
                                                <h6 class="font-italic font-weight-bold my-3"> <span class="pl-3">{{ currency($detailOrder->transaction_data['transaction_details']['gross_amount']) }}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row my-0 py-0">
                            <div class="col-4 pr-0 mt-2">
                                <div class="mb-3 mr-1">Recipent</div>
                                <div class="mb-3 mr-1">Phone</div>
                                <div class="mb-3 mr-1">City/Region</div>
                                <div class="mb-3 mr-1">Postal Code</div>
                                <div class="mb-3 mr-1">Country</div>
                                <div class="mb-3 mr-1">Full Address</div>
                            </div>
                            <div class="col-8 pl-0 mt-2">
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['first_name'] }} {{ $detailOrder->transaction_data['customer_details']['shipping_address']['last_name'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['phone'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['city'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['postal_code'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['country_name'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['address'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

            @endif

        </x-slot>
    </x-jet-dialog-modal>

</div>
