<x-guest-layout>

    <div class="user-auth blog">

        @livewire('header')

        <div class="main-content">
            <div class="wrap-banner">
                <x-breadcrumb :navs="[['title' => 'Home', 'url' => route('home')], ['title' => 'Forgot Password', 'url' => route('password.request')]]" />
            </div>

            <div class="wrapper-site">
                <div class="content-wrapper full-width">
                    <div class="main">
                        <div class="container">
                            <h1 class="text-center title-page">{{ __('Create Account') }}</h1>
                            <div class="register-form text-center">
                                <div class="row mb-5">
                                    <div class="col-sm-12">
                                        {{ __('No problem.Just let us know your email address and we will send an email to you a password reset link that allows you to choose a new one.') }}
                                    </div>
                                </div>
                                <form class="user" method="POST" action="{{ route('password.request') }}">
                                    @csrf
                                    <div class="form-group no-gutters">
                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Email Address" :value="old('email')" required />
                                        <x-jet-input-error for="email" />
                                    </div>

                                    <div class="clearfix my-4">
                                        <div>
                                            <button class="btn btn-primary" type="submit">{{ __('Reset Email password') }}</button>
                                        </div>
                                    </div>

                                    <div>
                                        @if (Route::has('register'))
                                            <div class="no-gutters text-center mb-1">
                                                <div class="forgot-password">
                                                    <a href="{{ route('register') }}">{{ __('Create an account!') }}</a>
                                                </div>
                                            </div>
                                        @endif
                                        @if (Route::has('register'))
                                            <div class="no-gutters text-center">
                                                <div class="forgot-password">
                                                    <a href="{{ route('login') }}">{{ __('Already has an account? Login!') }}</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </form>
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
