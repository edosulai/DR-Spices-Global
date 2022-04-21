<x-guest-layout>

    <div class="product-checkout checkout-cart">

        @livewire('header')

        <div class="checkout main-content">
            <div class="wrap-banner">

                <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => 'Checkout', 'url' => route('checkout')]]" />

                <div class="container">
                    <div class="row">
                        <div class="content-wrapper col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                            <div class="main">
                                @livewire('checkout')
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
