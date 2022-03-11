<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
            <div>
                <x-jet-dialog-modal wire:model="userModal">
                    <x-slot name="title">
                        {{ __('Tambah Data Pengguna') }}
                    </x-slot>

                    <x-slot name="close">
                        <x-jet-secondary-button wire:click="$toggle('userModal')" wire:loading.attr="disabled">
                            {{ __('x') }}
                        </x-jet-secondary-button>
                    </x-slot>

                    <x-slot name="content">

                        <div class="mb-3">
                            <x-jet-label for="name" value="{{ __('Nama Pengguna') }}" />
                            <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model="name" autocomplete="name" disabled />
                            <x-jet-input-error for="name" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="text" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" wire:model="email" autocomplete="email" disabled />
                            <x-jet-input-error for="email" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="created_at" value="{{ __('Waktu Daftar') }}" />
                            <x-jet-input id="created_at" type="datetime-local" class="{{ $errors->has('created_at') ? 'is-invalid' : '' }}" wire:model="created_at" autocomplete="created_at" disabled />
                            <x-jet-input-error for="created_at" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label for="role" value="{{ __('Role') }}" />
                            <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" wire:model="role" id="role" autocomplete="role">
                                @foreach ($roles as $r)
                                <option value="{!! $r->id !!}" wire:key="{{ $r->id }}" {!! $role == $r->id ? 'selected' : '' !!}>{{ $r->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="role" />
                        </div>

                    </x-slot>

                    <x-slot name="footer">
                        <div class="d-flex">
                            <x-jet-secondary-button class="mr-2" wire:click="$toggle('userModal')" wire:loading.attr="disabled">
                                {{ __('Batal') }}
                            </x-jet-secondary-button>

                            <x-jet-button class="d-flex align-items-center" wire:click="{{ $aksiUserModal }}" wire:loading.attr="disabled">
                                <span wire:loading wire:target="{{ $aksiUserModal }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                                {{ __($buttonUserModal) }}
                            </x-jet-button>
                        </div>
                    </x-slot>
                </x-jet-dialog-modal>

                <x-jet-confirmation-modal wire:model="deleteUserModalConfirm">
                    <x-slot name="title">
                        {{ __("Hapus Data Pengguna ") }}<i>{{$name}}</i>
                    </x-slot>

                    <x-slot name="content">
                        {{ __("Apakah Anda yakin ingin menghapus data pengguna ") }}<i>{{$name}} ?</i>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('deleteUserModalConfirm')" wire:loading.attr="disabled">
                            {{ __('Batal') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteUser">
                            <span wire:loading wire:target="deleteUser" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                            {{ __('Hapus') }}
                        </x-jet-danger-button>
                    </x-slot>
                </x-jet-confirmation-modal>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('user-table')
        </div>
    </div>
</div>