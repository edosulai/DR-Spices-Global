<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="text-truncate">
    {{ $row->alamat }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->telp }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-success" wire:click="$emit('supplierModal', '{{ $row->id }}')" wire:loading.attr="disabled">Edit</a>
        <a role="button" class="btn btn-danger" wire:click="$emit('deleteSupplierModal', '{{ $row->id }}')" wire:loading.attr="disabled">Hapus</a>
    </div>
</x-livewire-tables::bs4.table.cell>
