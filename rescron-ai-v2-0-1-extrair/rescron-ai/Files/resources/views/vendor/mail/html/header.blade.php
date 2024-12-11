@props(['url'])
<tr>
<td class="header">
<a href="{{ url('/') }}" style="display: inline-block;">
<img src="{{ asset('assets/images/' . site('logo_square')) }}" class="logo" alt="{{ site('name') }}">
</a>
</td>
</tr>
