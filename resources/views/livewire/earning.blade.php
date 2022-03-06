<div class="canvas_container" style="height: 20rem" id="earning_chart">
  @if($chart)
  {!! $chart->container() !!}
  @endif
</div>

@if($chart)
@push('scripts')
{!! $chart->script() !!}
@endpush
@endif