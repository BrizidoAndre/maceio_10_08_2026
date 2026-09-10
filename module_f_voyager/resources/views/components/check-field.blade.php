@props([
    'name',
    'id' => $name . \Illuminate\Support\Str::ulid(),
])

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="{{$id}}" name="{{$name}}" {{$attributes}}>
    <label class="form-check-label" for="{{$id}}">
        {{$slot}}
    </label>
</div>
