@props([
    'action'=> '',
    'method' => 'post'
])
<form action="{{$action}}" method="post" {{$attributes}} enctype="multipart/form-data">
    @method($method)
    @csrf
    {{$slot}}
</form>
