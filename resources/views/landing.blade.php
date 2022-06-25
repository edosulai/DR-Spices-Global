<x-guest-layout>

    <div class="contact blog home3 about-us product-detail">
        @livewire('header')
        <div class="main-content">
            <x-jumbotron />
            <div class="content-wrapper full-width">
                <div class="main mt-0">
                    <section class="page-home">
                        <div class="container">
                            <div class="section policy-home col-lg-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="policy-item">
                                                    <div class="policy-content iconpolicy1">
                                                        <img src="{{ asset('storage/images/others/home1-policy.png') }}" alt="img">
                                                        <div class="policy-name mb-5">FREE DELIVERY FROM $ 0</div>
                                                        <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dr-html col-lg-4 col-md-4">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="policy-item">
                                                    <div class="policy-content iconpolicy2">
                                                        <img src="{{ asset('storage/images/others/home1-policy2.png') }}" alt="img">
                                                        <div class="policy-name mb-5">FREE INSTALLATION</div>
                                                        <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dr-html col-lg-4 col-md-4">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="policy-item">
                                                    <div class="policy-content iconpolicy3">
                                                        <img src="{{ asset('storage/images/others/home1-policy3.png') }}" alt="img">
                                                        <div class="policy-name mb-5">MONEY BACK GUARANTEED</div>
                                                        <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section product-living-room">
                            <div class="container">
                                <div class="row">
                                    <div class="new-arrivals product-tab col">
                                        <div class="tab-content" id="product-exhibition">
                                            <div class="title-tab-content product-tab justify-content-between">
                                                <div class="title-product">
                                                    <h2>{{ __('Our Product') }}</h2>
                                                    <p>{{ __('A FULL LINE OF OUR SPICES') }}</p>
                                                </div>
                                            </div>
                                            @livewire('product-exhibition')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-about-us />
                        {{-- <x-partner /> --}}
                        @livewire('contact')

                    </section>
                </div>
            </div>
        </div>
        @livewire('footer')
        <x-back-top />
    </div>

</x-guest-layout>
