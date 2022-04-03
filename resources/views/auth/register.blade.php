<x-guest-layout>

    <div class="user-auth blog">

        @livewire('header')

        <div class="main-content">
            <div class="wrap-banner">
                <x-breadcrumb :navs="[
                    ['title' => 'Home', 'url' => route('home')],
                    ['title' => 'Create Account', 'url' => route('register')],
                ]" />
            </div>

            <div class="wrapper-site">
                <div class="content-wrapper full-width">
                    <div class="main">
                        <div class="container">
                            <h1 class="text-center title-page">{{ __('Create Account') }}</h1>
                            <div class="register-form text-center">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0 no-gutters">
                                            <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" placeholder="First Name" :value="old('name')" required autofocus autocomplete="name" />
                                            <x-jet-input-error for="name" />
                                        </div>
                                        <div class="col-sm-6 no-gutters">
                                            <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" placeholder="Last Name" :value="old('name')" required autofocus autocomplete="name" />
                                            <x-jet-input-error for="name" />
                                        </div>
                                    </div>
                                    <div class="form-group no-gutters">
                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Email Address" :value="old('email')" required />
                                        <x-jet-input-error for="email" />
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0 no-gutters">
                                            <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                            <x-jet-input-error for="password" />
                                        </div>
                                        <div class="col-sm-6 no-gutters">
                                            <x-jet-input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                        </div>
                                    </div>

                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-group row">
                                        <div class="pl-0 custom-control custom-checkbox">
                                            <x-jet-checkbox id="terms" name="terms" />
                                            <label class="custom-control-label" for="terms">
                                                {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Persyaratan Layanan').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Kebijakan pribadi').'</a>',
                                                ]) !!}
                                            </label>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="clearfix">
                                        <div>
                                            <button class="btn btn-primary" data-link-action="sign-in" type="submit">{{ __('Create Account') }}</button>
                                        </div>
                                    </div>

                                    <div>
                                        @if (Route::has('password.request'))
                                        <div class="no-gutters text-center mb-1">
                                            <div class="forgot-password">
                                                <a href="{{ route('password.request') }}">{{ __('Forgot your password ?') }}</a>
                                            </div>
                                        </div>
                                        @endif
                                        @if (Route::has('register'))
                                        <div class="no-gutters text-center">
                                            <div class="forgot-password">
                                                <a href="{{ route('login') }}">{{ __('Already have an account?') }}</a>
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

        <x-pre-loader />

        <x-back-top />

    </div>

</x-guest-layout>