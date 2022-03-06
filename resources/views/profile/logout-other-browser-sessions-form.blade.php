<x-jet-action-section>
    <x-slot name="title">
        {{ __('Sesi Peramban') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Kelola dan keluar dari sesi aktif Anda di browser dan perangkat lain.') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-action-message on="loggedOut">
            {{ __('Selesai.') }}
        </x-jet-action-message>

        <div>
            {{ __('Jika perlu, Anda dapat keluar dari semua sesi browser lainnya di semua perangkat Anda. Beberapa sesi terakhir Anda tercantum di bawah ini; namun, daftar ini mungkin tidak lengkap. Jika Anda merasa akun Anda telah disusupi, Anda juga harus memperbarui kata sandi Anda.') }}
        </div>

        @if (count($this->sessions) > 0)
        <div class="mt-3">
            <!-- Other Browser Sessions -->
            @foreach ($this->sessions as $session)
            <div class="d-flex">
                <div>
                    @if ($session->agent->isDesktop())
                    <svg fill="none" width="32" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                        <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                        <path d="M0 0h24v24H0z" stroke="none"></path>
                        <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                        <path d="M11 5h2M12 17v.01"></path>
                    </svg>
                    @endif
                </div>

                <div class="ms-2">
                    <div>
                        {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                    </div>

                    <div>
                        <div class="small font-weight-lighter text-muted">
                            {{ $session->ip_address }},

                            @if ($session->is_current_device)
                            <span class="text-success font-weight-bold">{{ __('Perangkat Ini') }}</span>
                            @else
                            {{ __('Terakhir aktif') }} {{ $session->last_active }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="d-flex mt-3">
            <x-jet-button class="d-flex align-items-center justify-content-center" wire:click="confirmLogout" wire:loading.attr="disabled">
                <span wire:loading class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Keluar Sesi Browser Lain') }}
            </x-jet-button>
        </div>

        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                {{ __('Keluar Sesi Browser Lain') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin keluar dari sesi browser lainnya di semua perangkat Anda.') }}

                <div class="mt-3 w-md-75" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" placeholder="{{ __('Password') }}" x-ref="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="d-flex">
                    <x-jet-secondary-button class="mr-2" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                        {{ __('Batal') }}
                    </x-jet-secondary-button>

                    <x-jet-button class="d-flex align-items-center" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                        <span wire:loading wire:target="logoutOtherBrowserSessions" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                        {{ __('Keluar Sesi Browser Lain') }}
                    </x-jet-button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>

</x-jet-action-section>