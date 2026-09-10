@props([
    'name',
])
<div class="mb-3">
    <label for="{{$name}}">{{$slot}}</label>
    <input class="form-control" name="{{$name}}" id="{{$name}}" {{$attributes->merge(['type' => 'text', 'value' => old($name,'')])}}>
</div>
