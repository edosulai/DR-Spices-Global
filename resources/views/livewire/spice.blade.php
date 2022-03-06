<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
            <div>
                <x-jet-button wire:click="openSpiceModal" wire:loading.attr="disabled">
                    Tambah Data
                </x-jet-button>

                <x-jet-dialog-modal wire:model="spiceModal">
                    <x-slot name="title">
                        {{ __('Tambah Data Rempah') }}
                    </x-slot>

                    <x-slot name="close">
                        <x-jet-secondary-button wire:click="$toggle('spiceModal')" wire:loading.attr="disabled">
                            {{ __('x') }}
                        </x-jet-secondary-button>
                    </x-slot>

                    <x-slot name="content">

                        <div class="mb-3">
                            <x-jet-label for="nama" value="{{ __('Nama Rempah') }}" />
                            <x-jet-input id="nama" type="text" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}" wire:model="nama" autocomplete="nama" />
                            <x-jet-input-error for="nama" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="hrg_jual" value="{{ __('Harga Jual') }}" />
                            <x-jet-input id="hrg_jual" type="number" class="{{ $errors->has('hrg_jual') ? 'is-invalid' : '' }}" wire:model="hrg_jual" autocomplete="hrg_jual" />
                            <x-jet-input-error for="hrg_jual" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="stok" value="{{ __('Stock') }}" />
                            <x-jet-input id="stok" type="number" class="{{ $errors->has('stok') ? 'is-invalid' : '' }}" wire:model="stok" autocomplete="stok" />
                            <x-jet-input-error for="stok" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="ket" value="{{ __('Keterangan') }}" />
                            <x-jet-input id="ket" type="text" class="{{ $errors->has('ket') ? 'is-invalid' : '' }}" wire:model="ket" autocomplete="ket" />
                            <x-jet-input-error for="ket" />
                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <div class="d-flex">
                            <x-jet-secondary-button class="mr-2" wire:click="$toggle('spiceModal')" wire:loading.attr="disabled">
                                {{ __('Batal') }}
                            </x-jet-secondary-button>

                            <x-jet-button class="d-flex align-items-center" wire:click="{{ $aksiSpiceModal }}" wire:loading.attr="disabled">
                                <span wire:loading wire:target="{{ $aksiSpiceModal }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                {{ __($buttonSpiceModal) }}
                            </x-jet-button>
                        </div>
                    </x-slot>
                </x-jet-dialog-modal>

                <x-jet-confirmation-modal wire:model="deleteSpiceModalConfirm">
                    <x-slot name="title">
                        {{ __("Hapus Data Rempah ") }}<i>{{$nama}}</i>
                    </x-slot>

                    <x-slot name="content">
                        {{ __("Apakah Anda yakin ingin menghapus data rempah ") }}<i>{{$nama}} ?</i>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('deleteSpiceModalConfirm')" wire:loading.attr="disabled">
                            {{ __('Batal') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteSpice">
                            <span wire:loading wire:target="deleteSpice" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            {{ __('Hapus') }}
                        </x-jet-danger-button>
                    </x-slot>
                </x-jet-confirmation-modal>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('spice-table')
        </div>
    </div>
</div>