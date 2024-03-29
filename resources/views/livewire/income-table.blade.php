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
    {{ $row->jumlah }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ currency($row->hrg_jual ? $row->hrg_jual : 0) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ currency($row->income_price ? $row->income_price : 0 ) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ Illuminate\Support\Carbon::parse($row->created_at)->format('d/m/Y - H:m:s') }}
</x-livewire-tables::bs4.table.cell>
