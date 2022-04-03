<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div x-data="{ recovery: false }">
                <div class="mb-3" x-show="! recovery">
                    {{ __('Harap konfirmasi akses ke akun Anda dengan memasukkan kode otentikasi yang disediakan oleh aplikasi authenticator Anda.') }}
                </div>

                <div class="mb-3" x-show="recovery">
                    {{ __('Harap konfirmasikan akses ke akun Anda dengan memasukkan salah satu kode pemulihan darurat Anda.') }}
                </div>

                <x-jet-validation-errors class="mb-3" />

                <form method="POST" action="{{ route('two-factor.login') }}">
                    @csrf

                    <div class="mb-3" x-show="! recovery">
                        <x-jet-label class="small" value="{{ __('Kode') }}" />
                        <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text"
                                     inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                        <x-jet-input-error for="code" />
                    </div>

                    <div class="mb-3" x-show="recovery">
                        <x-jet-label class="small" value="{{ __('Kode Pemulihan') }}" />
                        <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text"
                                     name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                        <x-jet-input-error for="recovery_code" />
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-outline-secondary"
                                x-show="! recovery"
                                x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                            {{ __('Gunakan kode pemulihan') }}
                        </button>

                        <button type="button" class="btn btn-outline-secondary"
                                x-show="recovery"
                                x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                            {{ __('Gunakan kode otentikasi') }}
                        </button>

                        <x-jet-button>
                            {{ __('Masuk') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>