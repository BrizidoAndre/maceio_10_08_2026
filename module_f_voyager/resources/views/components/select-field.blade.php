@props([
    'name',
    'label'
])
<div class="mb-3">
    <label for="{{$name}}">{{$label}}</label>
    <select name="{{$name}}" id="{{$name}}" class="form-select">
        <option value="">Select a value</option>
        {{$slot}}
    </select>
</div>
