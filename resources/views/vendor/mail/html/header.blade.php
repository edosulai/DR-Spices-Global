<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img class="logo" src="{{ asset('storage/images/others/logo.png') }}" alt="DR Spices Global Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
