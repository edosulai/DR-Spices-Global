<x-guest-layout>

    <div class="contact blog home3 about-us product-detail">
        @livewire('header')
        <div class="main-content">
            <div class="content-wrapper full-width">
                <div class="main mt-0">
                    <section class="page-home">
                        <div class="section product-living-room">
                            <div class="container">
                                <div class="row">
                                    <div class="new-arrivals product-tab col">
                                        <div class="tab-content" id="product-exhibition">
                                            <div class="title-tab-content product-tab justify-content-between">
                                                <div class="title-product">
                                                    <h2>{{ __('Our Product') }}</h2>
                                                    <p>{{ __('A FULL LINE OF OUR MAGGOTS') }}</p>
                                                </div>
                                            </div>
                                            @livewire('product-exhibition')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-about-us />

                    </section>
                </div>
            </div>
        </div>
        @livewire('footer')
        <x-back-top />
    </div>

</x-guest-layout>
