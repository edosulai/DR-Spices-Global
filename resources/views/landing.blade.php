<x-guest-layout>

    @livewire('header')

    <!-- main content -->
    <div class="main-content">

        @livewire('jumbotron')

        <div id="wrapper-site">
            <div id="content-wrapper" class="full-width">
                <div id="main">
                    <section class="page-home">
                        <!-- delivery form -->
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

                        @livewire('about-us')
    
                    </section>
                </div>
            </div>
        </div>

    </div>

    @livewire('footer')

</x-guest-layout>