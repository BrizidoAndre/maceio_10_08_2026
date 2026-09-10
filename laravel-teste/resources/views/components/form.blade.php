@props([
    'action',
    'method' => 'post',
])
<form method="post" action="{{$action}}" {{$attributes->merge([])}}>
    @method($method)
    @csrf
    {{$slot}}
</form>
