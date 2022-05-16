<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center px-3">
            <h6 class="m-0 font-weight-bold text-primary mr-auto">Data {{ $title }}</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @livewire('message-table')
        </div>
    </div>

    <x-feedback-modal wire:model="detailModal" :icon="'fas fa-envelope-open-text'">
        <x-slot name="title">
            {{ $modal->count() > 0 ? $modal->subject : '' }}
        </x-slot>

        <x-slot name="content">
            @if ($modal->count() > 0)
                <div class="row no-gutters align-items-center justify-content-between">
                    <div>
                        <h6 class="m-0">{{ $modal->name }}</h6>
                        <<span class="m-0">{{ $modal->email }}</span>>
                    </div>
                    <b>{{ $modal->created_at->format('M d, Y - H:m:s') }}</b>
                </div>
                <p>{{ $modal->message }}</p>
            @endif
        </x-slot>
    </x-feedback-modal>
</div>
