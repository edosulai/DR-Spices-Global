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
    {{-- <span class="badge badge-pill badge-warning">{{ $row->status_name }}</span> --}}
    {{ $row->status_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-secondary" wire:click="openModal('{{ $row->id }}')" wire:loading.attr="disabled">Manage</a>
    </div>
</x-livewire-tables::bs4.table.cell>
