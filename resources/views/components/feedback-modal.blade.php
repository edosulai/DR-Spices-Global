@props(['id' => null, 'maxWidth' => null, 'icon' => 'fa fa-check', 'footer' => false])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes->merge(['class' => 'blockcart in']) }}>
    <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title text-xs-center" id="myModalLabel"><i class="{{ $icon }}"></i>{{ $title }}</h4>
            <button type="button" class="close" aria-label="Close" wire:click="$set('cancelModal', false)">
                <i class="fas fa-times"></i>
            </button>
        </div>

        @if ($content)
            <div class="modal-body">
                {{ $content }}
            </div>
        @endif

        @if ($footer)
            <div class="modal-footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</x-modal>
