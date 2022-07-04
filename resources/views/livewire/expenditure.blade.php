<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
            <x-jet-button wire:click="openExpenditureModal" wire:loading.attr="disabled">
                Tambah Data
            </x-jet-button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('expenditure-table')
        </div>
    </div>

    <x-jet-dialog-modal wire:model="expenditureModal" :maxWidth="'sm'">
        <x-slot name="title">
            {{ __($buttonExpenditureModal . ' Data Pemasok') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label class="small" for="form.supplier_id" value="{{ __('Nama Supplier') }}" />
                <select id="form.supplier_id" class="form-control form-control-user {{ $errors->has('form.supplier_id') ? 'is-invalid' : '' }}" wire:model.defer="form.supplier_id" autocomplete="form.supplier_id">
                    <option {!! array_key_exists('supplier_id', $form) ? 'disabled' : 'selected' !!}>--Please choose an option--</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" wire:key="{{ $supplier->id }}" {!! array_key_exists('supplier_id', $form) ? ($form['supplier_id'] == $supplier->id ? 'selected' : '') : '' !!}>{{ $supplier->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="form.supplier_id" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.maggot_id" value="{{ __('Jenis Supplier') }}" />
                <select id="form.maggot_id" class="form-control form-control-user {{ $errors->has('form.maggot_id') ? 'is-invalid' : '' }}" wire:model.defer="form.maggot_id" autocomplete="form.maggot_id">
                    <option {!! array_key_exists('maggot_id', $form) ? 'disabled' : 'selected' !!}>--Please choose an option--</option>
                    @foreach ($maggots as $maggot)
                        <option value="{{ $maggot->id }}" wire:key="{{ $maggot->id }}" {!! array_key_exists('maggot_id', $form) ? ($form['maggot_id'] == $maggot->id ? 'selected' : '') : '' !!}>{{ $maggot->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="form.maggot_id" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.jumlah" value="{{ __('Jumlah Pasokan') }}" />
                <x-jet-input id="form.jumlah" type="number" class="{{ $errors->has('form.jumlah') ? 'is-invalid' : '' }}" wire:model="form.jumlah" autocomplete="form.jumlah" />
                <x-jet-input-error for="form.jumlah" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="d-flex d-md-flex">
                <x-jet-secondary-button class="mr-2" wire:click="$toggle('expenditureModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="d-flex align-items-center" wire:click="{{ $aksiExpenditureModal }}" wire:loading.attr="disabled">
                    <span wire:loading wire:target="{{ $aksiExpenditureModal }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    {{ __($buttonExpenditureModal) }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="deleteExpenditureModal">
        <x-slot name="title">
            {{ __('Hapus Data Pasokan ') }}<i>{{ array_key_exists('nama', $form) ? $form['nama'] : '' }}</i>
        </x-slot>

        <x-slot name="content">
            {{ __('Apakah Anda yakin ingin menghapus data pasokan dari ') }}<i>{{ array_key_exists('nama', $form) ? $form['nama'] : '' }} ?</i>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteExpenditureModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteExpenditure">
                <span wire:loading wire:target="deleteExpenditure" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
