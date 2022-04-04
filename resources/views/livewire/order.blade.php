<div class="myaccount-content">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Orders List') }}</h1>
  </div>

  @if ($orders->count() < 1) <p class="saved-message">{{ __('Your Orders List is Empty') }}</p>
    @endif

    <div class="row">
      @foreach ($orders as $order)
      <div class="col-md-12 mb-3">
        <div class="card shadow-sm">
          <div class="card-body pt-2">

            <div class="mb-4 d-flex">
              <div class="mr-auto">
                <small class="text-uppercase">Invoice : </small>
                <small>{{ $order->invoice }}</small>
              </div>
              <div class="ml-auto">
                <small>{{ $order->created_at->diffForHumans() }}</small>
                <span class="mx-2">|</span>
                <small class="text-uppercase">{{ $order->statuses_nama }}</small>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <span class="product-image media-middle">
                  <a href="{{ route('detail', ['product' => str_replace(' ', '-', $order->spice_data->nama)]) }}">
                    <img class="img-fluid" src="{{ asset('/storage/images/product/' . $order->spice_data->image) }}">
                  </a>
                </span>
              </div>
              <div class="col-md-10 d-flex flex-column">
                <div class="row">
                  <div class="col-md-9">
                    <h6 class="product-name">
                      <a href="{{ route('detail', ['product' => str_replace(' ', '-', $order->spice_data->nama)]) }}">{{ $order->spice_data->nama }}</a>
                    </h6>
                    <div class="product-meta">
                      <span class="product-price">{{ $order->jumlah }} x Rp. {{ number_format($order->spice_data->hrg_jual, 0, ',', '.') }}</span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="border-left pl-3">
                      <div>Total</div>
                      <div>Rp. {{ number_format($order->spice_data->hrg_jual * $order->jumlah, 0, ',', '.') }}</div>
                    </div>
                  </div>
                </div>
                <div class="ml-auto mt-auto">
                  <a role="button" wire:click="opemModalReview('{{ $order->id }}')">
                    <i class="fas fa-pen-square"></i>
                    <span>{{ __('Write a Review') }}</span>
                  </a>
                  <span class="mx-2">|</span>
                  <a role="button" wire:click="opemModalDetail('{{ $order->id }}')">
                    <i class="fas fa-receipt"></i>
                    <span>{{ __('Details') }}</span>
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      @endforeach
    </div>

    <x-jet-dialog-modal wire:model="reviewModal">
      <x-slot name="title">
        {{ __('Update Address') }}
      </x-slot>

      <x-slot name="content">
        <div class="row">

          <div class="col-md-6">
            <div class="mb-3">
              <x-jet-label class="small" for="recipent" value="{{ __('Recipent Name') }}" />
              <x-jet-input id="recipent" type="text" class="{{ $errors->has('recipent') ? 'is-invalid' : '' }}" wire:model.defer="review.recipent" />
              <x-jet-input-error for="recipent" />
            </div>
          </div>

        </div>
      </x-slot>

      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('reviewModal')" wire:loading.attr="disabled">
          {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="d-flex align-items-center" wire:loading.attr="disabled" wire:click="queryAddress">
          <span wire:loading wire:target="queryAddress" class="spinner-border spinner-border-sm mr-2" role="status"></span>
          {{ __('Save') }}
        </x-jet-danger-button>
      </x-slot>
    </x-jet-dialog-modal>

</div>