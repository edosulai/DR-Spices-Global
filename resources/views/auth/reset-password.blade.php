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
                                    @if (session('status'))
                                    <div class="alert alert-success mb-3 rounded-0" role="alert">
                                        {{ session('status') }}
                                    </div>
                                    @endif

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('Perbarui kata sandi Anda.') }}</h1>
                                    </div>

                                    <form class="user" method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Email') }}" />
                                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                            <x-jet-input-error for="email" />
                                        </div>

                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Password') }}" />
                                            <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" required autocomplete="new-password" />
                                            <x-jet-input-error for="password" />
                                        </div>
                        
                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Konfirmasi Password') }}" />
                                            <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" required autocomplete="new-password" />
                                            <x-jet-input-error for="password_confirmation" />
                                        </div>
                                        <x-jet-button>
                                            {{ __('Reset Password') }}
                                        </x-jet-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>