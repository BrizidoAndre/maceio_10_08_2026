@props([
    'name',
    'id' => $name
])

<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$slot}}</label>
    <input class="form-control" {{$attributes->merge([
    'id' => $name,
    'name' => $name,
    'value' => old($name,''),
])}}>
</div>
