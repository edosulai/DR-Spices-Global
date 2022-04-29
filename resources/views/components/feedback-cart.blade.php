@props(['id' => null, 'maxWidth' => null, 'modal' => []])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes->merge(['class' => 'blockcart in']) }}>
    <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title text-xs-center" id="myModalLabel"><i class="fa fa-check"></i>{{ __('Product successfully added to your shopping cart') }}</h4>
            <button type="button" class="close" aria-label="Close" wire:click="$set('feedbackCartAddModal', false)">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="modal-body row no-gutters">
            @if (count($modal) > 0)
                <div class="col-md-6 divide-right pr-4 row no-gutters align-items-center">
                    <div class="col-md-4">
                        <img class="product-image img-fluid" src="{{ $modal['image'] }}">
                    </div>
                    <div class="col-md-6 h-fit">
                        <div class="h5 product-name">{{ $modal['name'] }}</div>
                        <div class="product-price">{{ currency($modal['price']) }} <small>({{ $modal['unit'] }})</small></div>
                        <p>Quantity:&nbsp;{{ $modal['qty'] }}</p>
                    </div>
                </div>
                <div class="col-md-6 pl-4 row no-gutters align-items-center">
                    <div class="cart-content">
                        <p class="cart-products-count">There are {{ $modal['count'] }} items in your cart.</p>
                        <p>Total products:&nbsp;{{ currency($modal['total']) }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" wire:click="$set('feedbackCartAddModal', false)">{{ __('Continue shopping') }}</button>
            <a href="{{ route('checkout') }}" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i>{{ __('Proceed to checkout') }}</a>
        </div>
    </div>
</x-modal>
