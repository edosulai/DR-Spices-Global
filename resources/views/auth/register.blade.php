<x-guest-layout>
    <x-jet-authentication-card>
        {{-- <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <x-jet-validation-errors class="mb-3" />
        </x-slot> --}}

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            @if (session('status'))
                            <div class="alert alert-success mb-3 rounded-0" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <x-jet-label value="{{ __('First Name') }}" />
                                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" placeholder="First Name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-jet-input-error for="name"></x-jet-input-error>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-jet-label value="{{ __('Last Name') }}" />
                                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" placeholder="Last Name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-jet-input-error for="name"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <x-jet-label value="{{ __('Email') }}" />
                                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Email Address" :value="old('email')" required />
                                    <x-jet-input-error for="email"></x-jet-input-error>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <x-jet-label value="{{ __('Password') }}" />
                                        <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-jet-label value="{{ __('Confirm Password') }}" />
                                        <x-jet-input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                                    </div>
                                </div>
                                
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="form-group row">
                                    <div class="custom-control custom-checkbox">
                                        <x-jet-checkbox id="terms" name="terms" />
                                        <label class="custom-control-label" for="terms">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </label>
                                    </div>
                                </div>
                                @endif

                                <x-jet-button>
                                    {{ __('Register Account') }}
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
                                <a class="small" href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-jet-authentication-card>
</x-guest-layout>