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

                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf

                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Email') }}" />
                                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Enter Email Address..." aria-describedby="emailHelp" :value="old('email')" required />
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>
                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Password') }}" />
                                            <x-jet-input class="{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Enter Password..." required autocomplete="current-password" />
                                            <x-jet-input-error for="password"></x-jet-input-error>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <x-jet-checkbox id="remember_me" name="remember" />
                                                <label class="custom-control-label" for="remember_me">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <x-jet-button>
                                            {{ __('Log in') }}
                                        </x-jet-button>
                                    </form>
                                    <hr>
                                    @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    </div>
                                    @endif
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
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