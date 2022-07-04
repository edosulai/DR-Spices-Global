<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <img class="img-fluid" src="{{ asset("storage/images/products/$row->image") }}">
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->unit }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ currency($row->hrg_jual) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->stok }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="text-truncate">
    {{ $row->ket }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-success m-0 p-2" wire:click="$emit('maggotModal', '{{ $row->id }}')" wire:loading.attr="disabled">Edit</a>
        <a role="button" class="btn btn-danger m-0 p-2" wire:click="$emit('deleteMaggotModal', '{{ $row->id }}')" wire:loading.attr="disabled">Hapus</a>
    </div>
</x-livewire-tables::bs4.table.cell>
