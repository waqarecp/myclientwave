@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'My Client Wave')
<img src="https://myclientwave.com/assets/media/logos/my-client-wave-black-logo.png" class="logo" alt="{{ config('app.name') }} Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
