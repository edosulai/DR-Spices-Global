<x-guest-layout>
    <x-jet-authentication-card>
        {{-- <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <x-jet-validation-errors class="mb-3" />
        </x-slot> --}}

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">{{ __('Forgot your password?') }}</h1>
                                        <p class="mb-4">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.request') }}">
                                        @csrf
                                        <div class="form-group">
                                            <x-jet-label value="Email" />
                                            <x-jet-input type="email" name="email" placeholder="Enter Email Address..." :value="old('email')" required autofocus />
                                        </div>
                                        <x-jet-button>
                                            {{ __('Email Password Reset Link') }}
                                        </x-jet-button>
                                    </form>
                                    <hr>
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                                    </div>
                                    @endif
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>