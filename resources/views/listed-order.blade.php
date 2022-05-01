<x-guest-layout>

    <div class="blog">

        @livewire('header')

        <div class="checkout cart main-content">
            <div class="wrap-banner">

                <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => $title, 'url' => route('purchase', ['invoice' => $param])]]" />

                <div class="container">
                    <div class="row">
                        <div class="content-wrapper col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">

                            <div class="main">
                                <div class="row mb-5">
                                    <div class="col-sm-10 offset-sm-1 text-center">
                                        <p class="icon-addcart">
                                            <span><i class="fas fa-check"></i></span>
                                        </p>
                                        <h4 class="mb-4">Thank you for purchasing, Your order is complete</h4>
                                        <a href="{{ route('home') . '/#product-exhibition' }}" class="btn btn-primary btn-outline-primary">
                                            <i class="fa fa-shopping-cart"></i> Continue Shopping
                                        </a>
                                    </div>
                                </div>

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

                                <div class="row">
                                    <div class="cart-container col-md-7">
                                        <hr>
                                        <h6>{{ __('Product Details') }}</h6>
                                        <hr>
                                    </div>

                                    <div class="cart-container col-md-5">
                                        <hr>
                                        <h6>{{ __('Shipping Info') }}</h6>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="cart-container col-md-7">
                                        <div class="card">
                                            <div class="card-body">
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
                                                                        <div class="my-2">Shipping Cost / ({{ $detailOrder->spice_data[0]['unit'] }})</div>
                                                                        <div class="my-2">Total Shipping Cost x {{ collect($detailOrder->spice_data)->sum('jumlah') }}</div>
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
                                        </div>
                                    </div>

                                    <div class="cart-container col-md-5">
                                        <div class="card">
                                            <div class="card-body">
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
                                    </div>
                                </div>

                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('footer')
        <x-back-top />

    </div>

</x-guest-layout>
