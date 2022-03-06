<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->email }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ Illuminate\Support\Carbon::parse($row->created_at)->format('d/m/Y - H:m:s') }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @switch($row->roles->first()->id)
        @case(1)
            <span class="badge badge-pill badge-primary">{{ $row->getRoleNames()->first() }}</span>
            @break
            
        @case(2)
            <span class="badge badge-pill badge-secondary">{{ $row->getRoleNames()->first() }}</span>
            @break
        @default
            
    @endswitch
</x-livewire-tables::table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a href="#" class="btn btn-success" wire:click="openModal({{ $row->id }})" wire:loading.attr="disabled">Edit</a>
        <a href="#" class="btn btn-danger" wire:click="openDeleteModal({{ $row->id }})" wire:loading.attr="disabled">Hapus</a>
    </div>
</x-livewire-tables::table.cell>