<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('discounts.store')}}">
        <x-select-field label="Package" name="package_id">
            @foreach(\App\Models\Package::pluck('name','id') as $key=>$pack)
                <option @selected($key == old('package_id',false)) value="{{$key}}">{{$pack}}</option>
            @endforeach
        </x-select-field>
        <x-field name="min_people">Min_people</x-field>
        <x-field name="discount">Discount</x-field>
        <x-field name="start_date" type="date">Start_date</x-field>
        <x-field name="end_date" type="date">End_date</x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
