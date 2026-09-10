<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('locals.store')}}">
        <x-field name="city">City</x-field>
        <x-select-field name="country_id" label="Country">
            @foreach(\App\Models\Country::pluck('country','id') as $key => $name)
                <option value="{{$key}}">{{$name}}</option>
            @endforeach
        </x-select-field>
        <x-field name="description">Description</x-field>
        <x-field name="images[]" type="file" multiple >Images</x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
