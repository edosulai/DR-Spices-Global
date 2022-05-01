<x-guest-layout>

    <div class="contact blog">

        @livewire('header')

        <div class="main-content">
            <div class="content-wrapper">

                <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => $title, 'url' => route('contact')]]" />

                <div class="main">
                    <div class="page-home">
                        <div class="container">
                            <h1 class="text-center title-page">{{ $title }}</h1>
                            @livewire('contact')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('footer')
        <x-back-top />

    </div>

</x-guest-layout>
