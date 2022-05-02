<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('user-table')
        </div>
    </div>

    <x-jet-dialog-modal wire:model="userModal">
        <x-slot name="title">
            {{ __('Tambah Data Pengguna') }}
        </x-slot>

        <x-slot name="content">

            <div class="mb-3">
                <x-jet-label class="small" for="form.name" value="{{ __('Nama Pengguna') }}" />
                <x-jet-input id="form.name" type="text" class="{{ $errors->has('form.name') ? 'is-invalid' : '' }}" wire:model="form.name" autocomplete="form.name" disabled />
                <x-jet-input-error for="form.name" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.email" value="{{ __('Email') }}" />
                <x-jet-input id="form.email" type="text" class="{{ $errors->has('form.email') ? 'is-invalid' : '' }}" wire:model="form.email" autocomplete="form.email" disabled />
                <x-jet-input-error for="form.email" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.created_at" value="{{ __('Waktu Daftar') }}" />
                <x-jet-input id="form.created_at" type="datetime-local" class="{{ $errors->has('form.created_at') ? 'is-invalid' : '' }}" wire:model="form.created_at" autocomplete="form.created_at" disabled />
                <x-jet-input-error for="form.created_at" />
            </div>

            <div class="mb-3">
                <x-jet-label class="small" for="form.role" value="{{ __('Role') }}" />
                <select class="form-control form-control-user {{ $errors->has('form.role') ? 'is-invalid' : '' }}" wire:model.defer="form.role" id="form.role" autocomplete="form.role">
                    <option {!! array_key_exists('role', $form) ? 'disabled' : 'selected' !!}>--Please choose an option--</option>
                    @foreach ($roles as $r)
                        <option value="{!! $r->id !!}" wire:key="{{ $r->id }}" {!! array_key_exists('role', $form) ? ($form['role'] == $r->id ? 'selected' : '') : '' !!}>{{ $r->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="form.role" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="d-flex">
                <x-jet-secondary-button class="mr-2" wire:click="$toggle('userModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="d-flex align-items-center" wire:click="editUser" wire:loading.attr="disabled">
                    <span wire:loading wire:target="editUser" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    {{ __('Edit') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="deleteUserModalConfirm">
        <x-slot name="title">
            {{ __('Hapus Data Pengguna ') }}<i>{{ array_key_exists('nama', $form) ? $form['name'] : '' }}</i>
        </x-slot>

        <x-slot name="content">
            {{ __('Apakah Anda yakin ingin menghapus data pengguna ') }}<i>{{ array_key_exists('nama', $form) ? $form['name'] : '' }} ?</i>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteUserModalConfirm')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteUser">
                <span wire:loading wire:target="deleteUser" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
