<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->user_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->spice_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ Illuminate\Support\Carbon::parse($row->created_at)->format('d/m/Y - H:m:s') }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->jumlah }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @switch($row->status_id)
        @case(1)
            <span class="badge badge-pill badge-success">{{ $row->status_name }}</span>
            @break
            
        @case(2)
            <span class="badge badge-pill badge-warning">{{ $row->status_name }}</span>
            @break

        @case(3)
            <span class="badge badge-pill badge-primary">{{ $row->status_name }}</span>
            @break
            
        @case(4)
            <span class="badge badge-pill badge-danger">{{ $row->status_name }}</span>
            @break
            
    @endswitch
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a href="#" class="btn btn-secondary" wire:click="openModal('{{ $row->id }}')" wire:loading.attr="disabled">Manage</a>
    </div>
</x-livewire-tables::bs4.table.cell>