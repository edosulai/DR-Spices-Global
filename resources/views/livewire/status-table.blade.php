<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="text-truncate">
    {{ $row->ket }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-success" wire:click="$emit('statusModal', '{{ $row->id }}')" wire:loading.attr="disabled">Edit</a>
        <a role="button" class="btn btn-danger" wire:click="$emit('deleteStatusModal', '{{ $row->id }}')" wire:loading.attr="disabled">Hapus</a>
    </div>
</x-livewire-tables::bs4.table.cell>
