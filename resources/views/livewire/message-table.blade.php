<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->subject }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->format('M d, Y - H:m:s') }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-secondary m-0 p-2" wire:click="$emit('messageDetail', '{{ $row->id }}')" wire:loading.attr="disabled">Detail</a>
    </div>
</x-livewire-tables::bs4.table.cell>
