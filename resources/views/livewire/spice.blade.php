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
                            <x-jet-label for="nama" value="{{ __('Nama') }}" />
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
                        <x-jet-button class="ms-2" wire:click="tambahSpice" wire:loading.attr="disabled">
                            <div wire:loading wire:target="tambahSpice" class="spinner-border spinner-border-sm" role="status">

                            </div>
                            {{ __('Tambah') }}
                        </x-jet-button>
                    </x-slot>
                </x-jet-dialog-modal>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable_rempah" width="100%" cellspacing="0" style="table-layout: fixed;">
                <thead>
                    @foreach ($headers as $key => $value)
                    @if ($key == 'aksi')
                    <th style="{!! is_array($value) ? $value['style'] : '' !!}" class="text-center cursor-pointer">
                        {{ is_array($value) ? $value['label'] : $value }}
                    </th>
                    @else
                    <th style="{!! is_array($value) ? $value['style'] : '' !!}" class="text-center cursor-pointer" wire:click="sort('{{ $key }}')">
                        {{ is_array($value) ? $value['label'] : $value }}
                        @if($sortColumn == $key)
                        <span>{!! $sortDirection == 'asc' ? '&#8659;':'&#8657;' !!}</span>
                        @endif
                    </th>
                    @endif
                    @endforeach
                </thead>
                <tbody>
                    @if(count($data))
                    @foreach ($data as $item)
                    <tr>
                        @foreach ($headers as $key => $value)
                        <td class="text-nowrap text-truncate">
                            {!! is_array($value) ? $value['func']($item->$key) : $item->$key !!}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="{{ count($headers) }}">
                            <h2>No Results Found!</h2>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $data->links() }}

            <script>
                $(document).ready(function () {
                  $('#dataTable_rempah').DataTable()
                })
            </script>
        </div>
    </div>
</div>