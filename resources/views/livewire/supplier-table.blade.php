<x-livewire-tables::bs4.table.cell>
    {{ $index }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->alamat }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->telp }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a href="#" class="btn btn-success" wire:click="openModal({{ $row->id }})" wire:loading.attr="disabled">Edit</a>
        <a href="#" class="btn btn-danger" wire:click="openDeleteModal({{ $row->id }})" wire:loading.attr="disabled">Hapus</a>
    </div>
</x-livewire-tables::bs4.table.cell>