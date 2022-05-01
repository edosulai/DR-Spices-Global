<x-guest-layout>

    <div class="blog home3 about-us product-detail">
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
                                                        <img src="{{ asset('storage/images/home/home1-policy.png') }}" alt="img">
                                                        <div class="policy-name mb-5">FREE DELIVERY FROM $ 250</div>
                                                        <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tiva-html col-lg-4 col-md-4">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="policy-item">
                                                    <div class="policy-content iconpolicy2">
                                                        <img src="{{ asset('storage/images/home/home1-policy2.png') }}" alt="img">
                                                        <div class="policy-name mb-5">FREE INSTALLATION</div>
                                                        <div class="policy-des">Lorem ipsum dolor amet consectetur</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tiva-html col-lg-4 col-md-4">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="policy-item">
                                                    <div class="policy-content iconpolicy3">
                                                        <img src="{{ asset('storage/images/home/home1-policy3.png') }}" alt="img">
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
                        @livewire('product-exhibition')
                        <x-about-us />
                        <x-partner />
                    </section>
                </div>
            </div>
        </div>
        @livewire('footer')
        <x-back-top />
    </div>

</x-guest-layout>
