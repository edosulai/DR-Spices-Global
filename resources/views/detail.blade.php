<x-guest-layout>

    <div class="blog home3 about-us product-detail">
        @livewire('header')

        <div class="main-content">
            <div id="content-wrapper">
                <div id="main">
                    @livewire('product-detail')
                </div>
            </div>
        </div>

        <x-footer />
        <x-back-top />
    </div>

</x-guest-layout>
