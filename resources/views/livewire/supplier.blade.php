<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
            <div>
                <x-jet-button wire:click="openSupplierModal" wire:loading.attr="disabled">
                    Tambah Data
                </x-jet-button>

                <x-jet-dialog-modal wire:model="supplierModal">
                    <x-slot name="title">
                        {{ __('Tambah Data Supplier') }}
                    </x-slot>

                    <x-slot name="content">

                        <div class="mb-3">
                            <x-jet-label class="small" for="nama" value="{{ __('Nama Supplier') }}" />
                            <x-jet-input id="nama" type="text" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}" wire:model="nama" autocomplete="nama" />
                            <x-jet-input-error for="nama" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label class="small" for="alamat" value="{{ __('Alamat') }}" />
                            <x-jet-input id="alamat" type="text" class="{{ $errors->has('alamat') ? 'is-invalid' : '' }}" wire:model="alamat" autocomplete="alamat" />
                            <x-jet-input-error for="alamat" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label class="small" for="telp" value="{{ __('Telp') }}" />
                            <x-jet-input id="telp" type="text" class="{{ $errors->has('telp') ? 'is-invalid' : '' }}" wire:model="telp" autocomplete="telp" />
                            <x-jet-input-error for="telp" />
                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <div class="d-flex">
                            <x-jet-secondary-button class="mr-2" wire:click="$toggle('supplierModal')" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-jet-secondary-button>

                            <x-jet-button class="d-flex align-items-center" wire:click="{{ $aksiSupplierModal }}" wire:loading.attr="disabled">
                                <span wire:loading wire:target="{{ $aksiSupplierModal }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                {{ __($buttonSupplierModal) }}
                            </x-jet-button>
                        </div>
                    </x-slot>
                </x-jet-dialog-modal>

                <x-jet-confirmation-modal wire:model="deleteSupplierModalConfirm">
                    <x-slot name="title">
                        {{ __("Hapus Data Supplier ") }}<i>{{$nama}}</i>
                    </x-slot>

                    <x-slot name="content">
                        {{ __("Apakah Anda yakin ingin menghapus data supplier ") }}<i>{{$nama}} ?</i>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('deleteSupplierModalConfirm')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteSupplier">
                            <span wire:loading wire:target="deleteSupplier" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    </x-slot>
                </x-jet-confirmation-modal>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('supplier-table')
        </div>
    </div>
</div>
