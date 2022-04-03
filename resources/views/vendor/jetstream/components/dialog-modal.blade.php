@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">{{ $title }}</h6>
            {{ $close ?? '' }}
        </div>
        <div class="modal-body">
            {{ $content }}
        </div>
        <div class="modal-footer bg-light">
            {{ $footer }}
        </div>
    </div>
</x-jet-modal>