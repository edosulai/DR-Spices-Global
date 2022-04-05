@props(['id' => null, 'maxWidth' => null, 'footer' => false])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content content">
        <div class="modal-header">
            <h6 class="modal-title text-xs-center">{{ $title }}</h6>
            {{ $close ?? '' }}
        </div>
        <div class="modal-body p-3">
            {{ $content }}
        </div>
        @if ($footer)
            <div class="modal-footer bg-light">
                {{ $footer }}
            </div>
        @endif
    </div>
</x-jet-modal>
