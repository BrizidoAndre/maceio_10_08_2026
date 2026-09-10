@props([
    'name',
])

<div class="mb-3">
    <label for="{{$name}}" class="form-label">
        {{$slot}}
    </label>
    <input class="form-control" id="{{$name}}" {{$attributes->merge([
    'type' => 'text',
    'name' => $name,
])}}>
</div>
