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
                                <h1 class="title-page text-center">{{ $title }}</h1>

                                <div class="track">
                                    @foreach ($trace_order as $trace)
                                        <div class="step active">
                                            <span class="icon"><i class="{{ $trace->icon }}"></i></span>
                                            <span class="text">{{ $trace->nama }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="cart-container col-md-6 col-xs-12">
                                        <hr>
                                        <h6>{{ __('Product Details') }}</h6>
                                        <hr>
                                    </div>

                                    <div class="cart-container col-md-6 col-xs-12">
                                        <hr>
                                        <h6>{{ __('Shipping Info') }}</h6>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="cart-container col-md-6 col-xs-12">
                                        <div class="card">
                                            <div class="card-body row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img class="product-image img-fluid" src="{{ $detail_order ? asset('/storage/images/product/' . $detail_order->spice_data->image) : '' }}">
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
                                                                <div class="mb-2">{{ $detail_order ? $detail_order->spice_data->nama : '' }}</div>
                                                                <div class="mb-2">{{ $detail_order ? currency($detail_order->spice_data->hrg_jual) : 0 }}</div>
                                                                <div class="mb-2">{{ $detail_order ? $detail_order->spice_data->unit : '' }}</div>
                                                                <div class="mb-2">{{ $detail_order ? $detail_order->jumlah : 0 }}</div>
                                                                <div class="mb-2">{{ $detail_order ? currency($detail_order->spice_data->hrg_jual * $detail_order->jumlah) : 0 }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-container col-md-6 col-xs-12">
                                        <hr>
                                        <h6>{{ __('Shipping Info') }}</h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />
        <x-back-top />

    </div>

</x-guest-layout>
