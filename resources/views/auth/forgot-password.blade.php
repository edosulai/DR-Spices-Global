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
                                        <h1 class="h4 text-gray-900 mb-2">{{ __('Lupa kata sandi Anda?') }}</h1>
                                        <p class="mb-4">{{ __('Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirim email kepada Anda tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}</p>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.request') }}">
                                        @csrf
                                        <div class="form-group">
                                            <x-jet-label class="small" value="Email" />
                                            <x-jet-input type="email" name="email" placeholder="Enter Email Address..." :value="old('email')" required autofocus />
                                        </div>
                                        <x-jet-button>
                                            {{ __('Tautan Atur Ulang Kata Sandi Email') }}
                                        </x-jet-button>
                                    </form>
                                    <hr>
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">{{ __('Buat sebuah akun!') }}</a>
                                    </div>
                                    @endif
                                    @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">{{ __('Sudah memiliki akun? Masuk!') }}</a>
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