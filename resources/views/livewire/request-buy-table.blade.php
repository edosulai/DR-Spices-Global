<x-livewire-tables::bs4.table.cell>
    {{ $row->no }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->invoice }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->users_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->spice_nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ Illuminate\Support\Carbon::parse($row->created_at)->format('d/m/Y - H:m:s') }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->jumlah }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <span class="badge badge-pill badge-warning">{{ $row->statuses_nama }}</span>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell class="no-print">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <a role="button" class="btn btn-secondary" wire:click="$emit('requestBuyModal', '{{ $row->id }}')" wire:loading.attr="disabled">Kelola</a>
    </div>
</x-livewire-tables::bs4.table.cell>
