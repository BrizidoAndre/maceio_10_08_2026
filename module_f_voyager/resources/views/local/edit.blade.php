<x-layout>
    <h1>Update</h1>
    <x-form action="{{route('locals.update', $local)}}" method="put">
        <x-field value="{{$local->city}}" name="city">City</x-field>
        <x-select-field name="country_id" label="Country">
            @foreach(\App\Models\Country::pluck('country','id') as $key => $name)
                <option @selected($key === $local->country_id) value="{{$key}}">{{$name}}</option>
            @endforeach
        </x-select-field>
        <x-field value="{{$local->description}}" name="description">Description</x-field>
        <x-field name="images[]" type="file" multiple>Images</x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
