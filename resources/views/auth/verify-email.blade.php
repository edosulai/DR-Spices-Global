<x-guest-layout>

    <div class="user-auth blog">

        @livewire('header')

        <div class="main-content">
            <div class="wrap-banner">
                <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => 'Email Verification', 'url' => route('verification.notice')]]" />
            </div>

            <div class="wrapper-site">
                <div class="content-wrapper full-width">
                    <div class="main">
                        <div class="container">
                            <h1 class="text-center title-page">{{ __('Email Verification') }}</h1>
                            <div class="register-form text-center">
                                <div class="row mb-5">
                                    <div class="col-sm-12">
                                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>
                                </div>

                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif

                                <form class="user" method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="clearfix my-5">
                                        <x-jet-button type="submit">
                                            {{ __('Resend Verification Email') }}
                                        </x-jet-button>
                                    </div>
                                </form>
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
