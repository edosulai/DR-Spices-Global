<div style="height: 20rem" id="stok_chart">
    @if($chart)
    {!! $chart->container() !!}
    @endif
</div>

@if($chart)
@push('scripts')
{!! $chart->script() !!}
@endpush
@endif