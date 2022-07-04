<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
            <x-jet-button wire:click="openMaggotModal" wire:loading.attr="disabled">
                Tambah Data
            </x-jet-button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('maggot-table')
        </div>
    </div>

    <x-jet-dialog-modal wire:model="maggotModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ __($buttonMaggotModal . ' Data Maggot') }}
        </x-slot>

        <x-slot name="content">
            <div class="row no-gutters">
                <div class="product-detail col-md-4 pr-3">
                    <x-jet-label class="small" for="image" value="{{ __('Gambar Maggot') }}" />

                    {{-- <div class="card mb-3">
                        <div class="d-flex flex-column align-items-center">
                            @if (array_key_exists('img', $form) && $form['img'] != null && !$errors->has('form.img'))
                                <img class="img-fluid" src="{{ $form['img']->temporaryUrl() }}">
                            @elseif (array_key_exists('src', $form) && $form['src'] != null)
                                <img class="img-fluid" src="{{ $form['src'] }}">
                            @else
                                <p class="text-center mt-3">{{ __('No Image Found') }}</p>
                                <label class="btn icon-address" for="form.img">
                                    <span><i class="fas fa-plus"></i></span>
                                    <h6 class="text-center mt-3">{{ __('Add New Image') }}</h6>
                                </label>
                            @endif
                        </div>
                        <div class="card-body p-1">
                            <input type="file" hidden class="{{ $errors->has('form.img') ? 'is-invalid' : '' }}" wire:model="form.img" id="form.img">
                            <x-jet-input-error for="form.img" />
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-around">
                        @if ((array_key_exists('img', $form) && $form['img'] != null && !$errors->has('form.img')) || (array_key_exists('src', $form) && $form['src'] != null))
                            <label class="text-center cursor-pointer m-0 p-0" for="form.img">
                                <i class="fas fa-edit"></i>
                                {{ __('Change Image') }}
                            </label>
                        @endif

                        @if (array_key_exists('img', $form) && !$errors->has('form.img'))
                            <div>|</div>
                            <a type="button" wire:click="$set('form.img', '')">
                                <i class="far fa-trash-alt"></i>
                                {{ __('Remove Image') }}
                            </a>
                        @endif
                    </div> --}}

                    <div class="images-container">
                        <div class="js-qv-mask mask tab-content border">
                            @for ($i = 0; $i < 4; $i++)
                                <div id="item-{{ $i }}" class="tab-pane fade {{ $i == 0 ? 'active show' : '' }}" role="tabpanel">
                                    @if (array_key_exists('img', $form) && array_key_exists($i, $form['img']) && $form['img'][$i] != '' && !$errors->has('form.img.' . $i))
                                        <img src="{{ $form['img'][$i]->temporaryUrl() }}">
                                        <div class="layer-left-top" wire:click="$set('form.img.{{ $i }}', '')">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <label class="layer-right-bottom" for="form.img.{{ $i }}">
                                            <i class="fas fa-edit"></i>
                                        </label>
                                    @elseif (array_key_exists('src', $form) && array_key_exists($i, $form['src']) && $form['src'][$i] != '')
                                        <img src="{{ asset('storage/images/products/' . $form['src'][$i]) }}">
                                        <div class="layer-left-top" wire:click="removeImage({{ $i }})">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <label class="layer-right-bottom" for="form.img.{{ $i }}">
                                            <i class="fas fa-edit"></i>
                                        </label>
                                    @else
                                        <p class="text-center mt-3">{{ __('No Image Found') }}</p>
                                        <label class="btn icon-address" for="form.img.{{ $i }}">
                                            <span><i class="fas fa-plus"></i></span>
                                            <h6 class="text-center mt-3">{{ __('Add New Image') }}</h6>
                                        </label>
                                    @endif
                                </div>
                                <input type="file" hidden class="{{ $errors->has('form.img.' . $i) ? 'is-invalid' : '' }}" wire:model="form.img.{{ $i }}" id="form.img.{{ $i }}">
                                <x-jet-input-error for="form.img.{{ $i }}" />
                            @endfor
                        </div>
                        <ul class="product-tab nav nav-tabs d-flex" role="tablist">
                            @for ($i = 0; $i < 4; $i++)
                                @if (array_key_exists('img', $form) && array_key_exists($i, $form['img']) && $form['img'][$i] != '' && !$errors->has('form.img.' . $i))
                                    <li class="col {{ $i == 0 ? 'active' : '' }}">
                                        <a href="#item-{{ $i }}" data-toggle="tab" class="{{ $i == 0 ? 'active' : '' }}">
                                            <img src="{{ $form['img'][$i]->temporaryUrl() }}">
                                        </a>
                                    </li>
                                @elseif (array_key_exists('src', $form) && array_key_exists($i, $form['src']) && $form['src'][$i] != '')
                                    <li class="col {{ $i == 0 ? 'active' : '' }}">
                                        <a href="#item-{{ $i }}" data-toggle="tab" class="{{ $i == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/images/products/' . $form['src'][$i]) }}">
                                        </a>
                                    </li>
                                @else
                                    <li class="col {{ $i == 0 ? 'active' : '' }}">
                                        <a href="#item-{{ $i }}" data-toggle="tab" class="{{ $i == 0 ? 'active' : '' }}">
                                            <label class="btn icon-address m-0">
                                                <span class="w-fit h-fit"><i class="fas fa-image"></i></span>
                                            </label>
                                        </a>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                    </div>

                </div>
                <div class="col-md-8 pl-4">
                    <div class="mb-3 row">
                        <div class="col-6">
                            <x-jet-label class="small" for="form.nama" value="{{ __('Nama Maggot') }}" />
                            <x-jet-input id="form.nama" type="text" class="{{ $errors->has('form.nama') ? 'is-invalid' : '' }}" wire:model="form.nama" autocomplete="form.nama" />
                            <x-jet-input-error for="form.nama" />
                        </div>
                        <div class="col-6">
                            <x-jet-label class="small" for="form.hrg_jual" value="{{ __('Harga Jual') }}" />
                            <x-jet-input id="form.hrg_jual" type="number" class="{{ $errors->has('form.hrg_jual') ? 'is-invalid' : '' }}" wire:model="form.hrg_jual" autocomplete="form.hrg_jual" />
                            <x-jet-input-error for="form.hrg_jual" />
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-6">
                            <x-jet-label class="small" for="form.stok" value="{{ __('Stock') }}" />
                            <x-jet-input id="form.stok" type="number" class="{{ $errors->has('form.stok') ? 'is-invalid' : '' }}" wire:model="form.stok" autocomplete="form.stok" />
                            <x-jet-input-error for="form.stok" />
                        </div>
                        <div class="col-6">
                            <x-jet-label class="small" for="form.unit" value="{{ __('Unit/Satuan') }}" />
                            <x-jet-input id="form.unit" type="text" class="{{ $errors->has('form.unit') ? 'is-invalid' : '' }}" wire:model="form.unit" autocomplete="form.unit" disabled />
                            <x-jet-input-error for="form.unit" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-jet-label class="small" for="form.ket" value="{{ __('Keterangan') }}" />
                        <textarea id="form.ket" type="text" class="{{ $errors->has('form.ket') ? 'is-invalid' : '' }} form-control form-control-user rounded-sm" wire:model="form.ket" autocomplete="form.ket" rows="4"></textarea>
                        <x-jet-input-error for="form.ket" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="d-flex">
                <x-jet-secondary-button class="mr-2" wire:click="$toggle('maggotModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="d-flex align-items-center" wire:click="{{ $aksiMaggotModal }}" wire:loading.attr="disabled">
                    <span wire:loading wire:target="{{ $aksiMaggotModal }}" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                    {{ __($buttonMaggotModal) }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="deleteMaggotModal">
        <x-slot name="title">
            {{ __('Hapus Data Maggot ') }}<i>{{ array_key_exists('nama', $form) ? $form['nama'] : '' }}</i>
        </x-slot>

        <x-slot name="content">
            {{ __('Apakah Anda yakin ingin menghapus data maggot ') }}<i>{{ array_key_exists('nama', $form) ? $form['nama'] : '' }} ?</i>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteMaggotModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="deleteMaggot">
                <span wire:loading wire:target="deleteMaggot" class="spinner-border spinner-border-sm mr-2" role="status"></span>
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
