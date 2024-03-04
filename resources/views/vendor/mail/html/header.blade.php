<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Task organizer')
{{-- helper asset aponta para public e trim retira espaços em branco das extremidade --}}
{{--helper url aponta para url base da aplicaçãos--}}
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx341Vi14I1cV6j9yTvwArIkrYPxD_xVQ5rg&usqp=CAU" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
