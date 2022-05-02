<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('request-buy-table')
        </div>
    </div>

    <x-jet-dialog-modal wire:model="requestModal">
        <x-slot name="title">{{ array_key_exists('invoice', $form) ? $form['invoice'] : '' }}</x-slot>

        <x-slot name="content">

            <div class="mb-3">
                <x-jet-label class="small" for="form.users_name" value="{{ __('Nama Pengguna') }}" />
                <x-jet-input id="form.users_name" type="text" class="{{ $errors->has('form.users_name') ? 'is-invalid' : '' }}" wire:model="form.users_name" autocomplete="form.users_name" disabled />
                <x-jet-input-error for="form.users_name" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.spice_nama" value="{{ __('Jenis Rempah') }}" />
                <x-jet-input id="form.spice_nama" type="text" class="{{ $errors->has('form.spice_nama') ? 'is-invalid' : '' }}" wire:model="form.spice_nama" autocomplete="form.spice_nama" disabled />
                <x-jet-input-error for="form.spice_nama" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.jumlah" value="{{ __('Jumlah') }}" />
                <x-jet-input id="form.jumlah" type="text" class="{{ $errors->has('form.jumlah') ? 'is-invalid' : '' }}" wire:model="form.jumlah" autocomplete="form.jumlah" disabled />
                <x-jet-input-error for="form.jumlah" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.created_at" value="{{ __('Waktu Pemesanan') }}" />
                <x-jet-input id="form.created_at" type="datetime-local" class="{{ $errors->has('form.created_at') ? 'is-invalid' : '' }}" wire:model="form.created_at" autocomplete="form.created_at" disabled />
                <x-jet-input-error for="form.created_at" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.status_id" value="{{ __('Status Pengiriman') }}" />
                <select id="form.status_id" class="form-control form-control-user {{ $errors->has('form.status_id') ? 'is-invalid' : '' }}" wire:model.defer="form.status_id" autocomplete="form.status_id">
                    <option {!! array_key_exists('status_id', $form) ? 'disabled' : 'selected' !!}>--Please choose an option--</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" wire:key="{{ $status->id }}" {!! array_key_exists('status_id', $form) ? $form['status_id'] == $status->id ? 'selected disabled' : '' : '' !!}>{{ $status->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="form.status_id" />
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
