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

    <x-jet-dialog-modal wire:model="detailModal" :maxWidth="'lg'">
        <x-slot name="title">
            {{ 'Order Status' }}
        </x-slot>

        <x-slot name="close">
            <button type="button" class="close" aria-label="Close" wire:click="$set('detailModal', false)">
                <i class="fas fa-times"></i>
            </button>
        </x-slot>

        <x-slot name="content">
            @if ($detailOrder)
                <div class="card">
                    <div class="card-body row">
                        <div class="col">
                            <strong>Purchase date:</strong>
                            <br>
                            <span>{{ $detailOrder->created_at->format('M d, Y - H:m:s') }}</span>
                        </div>
                        <div class="col">
                            <strong>Status:</strong>
                            <br>
                            <span>{{ $detailOrder->statuses_nama }}</span>
                        </div>
                        <div class="col">
                            <strong>Total Price :</strong>
                            <br>
                            <span>{{ currency($detailOrder->transaction_data['transaction_details']['gross_amount']) }}</span>
                        </div>
                        <div class="col">
                            <strong>Invoice :</strong>
                            <br>
                            <span>{{ $detailOrder->invoice }}</span>
                        </div>
                    </div>
                </div>
                <div class="track">
                    @foreach ($traceOrder as $trace)
                        <div class="step active">
                            <span class="icon"><i class="{{ $trace->icon }}"></i></span>
                            <span class="text">{{ $trace->nama }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="row py-0">
                    <div class="col-7">
                        <hr>
                        <h6>{{ __('Product Details') }}</h6>
                        <hr>
                    </div>
                    <div class="col-5">
                        <hr>
                        <h6>{{ __('Shipping Details') }}</h6>
                        <hr>
                    </div>
                </div>

                <div class="row py-0">
                    <div class="col-7">
                        {{-- <div class="row my-0 py-0 overflow-auto" style="height: 150px"> --}}
                        <div class="row my-0 py-0">
                            @foreach ($detailOrder->spice_data as $spice)
                                <div class="col-12">
                                    <div class="row my-0 py-0">
                                        <div class="col-md-2">
                                            <span class="product-image media-middle">
                                                <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">
                                                    <img class="img-fluid" src="{{ asset('/storage/images/product/' . $spice['image']) }}">
                                                </a>
                                            </span>
                                        </div>

                                        <div class="col-md-10 d-flex flex-column justify-content-center">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <h6 class="product-name">
                                                        <a href="{{ route('detail', ['product' => str_replace(' ', '-', $spice['nama'])]) }}">{{ $spice['nama'] }}</a>
                                                    </h6>
                                                    <div class="product-meta">
                                                        <span class="product-price">{{ $spice['jumlah'] }} x {{ currency($spice['hrg_jual']) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 d-flex align-items-center">
                                                    <div class="border-left pl-3">
                                                        <div>Total</div>
                                                        <div class="font-italic">{{ currency($spice['hrg_jual'] * $spice['jumlah']) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                </div>
                            @endforeach

                            <div class="col-12 mt-3">
                                <div class="row my-0 py-0">
                                    <div class="col-md-2">
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="my-2">Product Total</div>
                                                <div class="my-2">Shipping Cost / ({{ $detailOrder->spice_data[0]['unit'] }})</div>
                                                <div class="my-2">Total Shipping Cost x {{ collect($detailOrder->spice_data)->sum('jumlah') }}</div>
                                                <h6 class="my-3">Total Price</h6>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency(
                                                    collect($detailOrder->spice_data)->sum(function ($spice) {
                                                        return $spice['hrg_jual'] * $spice['jumlah'];
                                                    }),
                                                ) }}</span></div>
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency($detailOrder->transaction_data['postage']['cost']) }}</span></div>
                                                <div class="font-italic my-2">: <span class="pl-3">{{ currency($detailOrder->transaction_data['postage']['cost'] * collect($detailOrder->spice_data)->sum('jumlah')) }}</span></div>
                                                <h6 class="font-italic font-weight-bold my-3"> <span class="pl-3">{{ currency($detailOrder->transaction_data['transaction_details']['gross_amount']) }}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="row my-0 py-0">
                            <div class="col-4 pr-0 mt-2">
                                <div class="mb-3 mr-1">Penerima</div>
                                <div class="mb-3 mr-1">Telepon</div>
                                <div class="mb-3 mr-1">Alamat 1</div>
                                <div class="mb-3 mr-1">Alamat 2</div>
                                <div class="mb-3 mr-1">Daerah</div>
                                <div class="mb-3 mr-1">Kota/Wilayah</div>
                                <div class="mb-3 mr-1">Provinsi</div>
                                <div class="mb-3 mr-1">Postal Code</div>
                                <div class="mb-3 mr-1">Negara</div>
                                <div class="mb-3 mr-1">Alamat Lengkap</div>
                            </div>
                            <div class="col-8 pl-0 mt-2">
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['first_name'] }} {{ $detailOrder->transaction_data['customer_details']['shipping_address']['last_name'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['phone'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['street'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['other_street'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['district'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['city'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['state'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['postal_code'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['country_name'] }}</div>
                                <div class="font-italic mb-3">: {{ $detailOrder->transaction_data['customer_details']['shipping_address']['address'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

            @endif

        </x-slot>

    </x-jet-dialog-modal>
</div>
