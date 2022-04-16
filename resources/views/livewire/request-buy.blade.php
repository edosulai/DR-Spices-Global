<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>

            <x-jet-dialog-modal wire:model="requestModal">
                <x-slot name="title">{{ $invoice }}</x-slot>

                <x-slot name="content">

                    <div class="mb-3">
                        <x-jet-label class="small" for="users_name" value="{{ __('Nama Pengguna') }}" />
                        <x-jet-input id="users_name" type="text" class="{{ $errors->has('users_name') ? 'is-invalid' : '' }}" wire:model="users_name" autocomplete="users_name" disabled />
                        <x-jet-input-error for="users_name" />
                    </div>

                    <div class="mb-3">
                        <x-jet-label class="small" for="spice_nama" value="{{ __('Jenis Rempah') }}" />
                        <x-jet-input id="spice_nama" type="text" class="{{ $errors->has('spice_nama') ? 'is-invalid' : '' }}" wire:model="spice_nama" autocomplete="spice_nama" disabled />
                        <x-jet-input-error for="spice_nama" />
                    </div>

                    <div class="mb-3">
                        <x-jet-label class="small" for="jumlah" value="{{ __('Jumlah') }}" />
                        <x-jet-input id="jumlah" type="text" class="{{ $errors->has('jumlah') ? 'is-invalid' : '' }}" wire:model="jumlah" autocomplete="jumlah" disabled />
                        <x-jet-input-error for="jumlah" />
                    </div>

                    <div class="mb-3">
                        <x-jet-label class="small" for="created_at" value="{{ __('Waktu Pemesanan') }}" />
                        <x-jet-input id="created_at" type="datetime-local" class="{{ $errors->has('created_at') ? 'is-invalid' : '' }}" wire:model="created_at" autocomplete="created_at" disabled />
                        <x-jet-input-error for="created_at" />
                    </div>

                    <div class="mb-3">
                        <x-jet-label class="small" for="status_id" value="{{ __('Status Pengiriman') }}" />
                        <select class="form-control form-control-user {{ $errors->has('status_id') ? 'is-invalid' : '' }}" wire:model="status_id" id="status_id" autocomplete="status_id">
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" wire:key="{{ $status->id }}" {!! $status_id == $status->id ? 'selected disabled' : '' !!}>{{ $status->nama }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="status_id" />
                    </div>

                </x-slot>

                <x-slot name="footer">
                    <div class="d-flex">
                        <x-jet-secondary-button class="mr-2" wire:click="$toggle('requestModal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-button class="d-flex align-items-center" wire:click="editRequestBuy" wire:loading.attr="disabled">
                            <span wire:loading wire:target="editRequestBuy" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            {{ __('Edit') }}
                        </x-jet-button>
                    </div>
                </x-slot>
            </x-jet-dialog-modal>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('request-buy-table')
        </div>
    </div>
</div>
