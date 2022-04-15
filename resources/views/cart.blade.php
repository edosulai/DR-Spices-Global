<x-guest-layout>

    <div class="product-cart checkout-cart blog">

        @livewire('header')

        <div class="main-content cart">

            <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => 'Shopping Cart', 'url' => route('cart')]]" />

            <div class="container">
                <div class="row">
                    <div class="content-wrapper col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                        <section class="main">
                            @livewire('cart')
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />



        <x-back-top />

    </div>

</x-guest-layout>
