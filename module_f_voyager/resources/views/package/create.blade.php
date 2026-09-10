<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('packages.store')}}">
        <x-field name="name">Name</x-field>
        <x-field name="description">Description</x-field>
        <x-field name="price">Price</x-field>
        <x-field name="start_date" type="date">Start_date</x-field>
        <x-field name="end_date" type="date">End_date</x-field>
        <x-field name="minimum_people">Minimum_people</x-field>
        <x-field name="maximum_people">Maximum_people</x-field>
        <p>Destinations</p>
        @foreach(\App\Models\Local::pluck('city','id') as $key => $name)
            <x-check-field name="locations[]" value="{{$key}}">{{$name}}</x-check-field>
        @endforeach

        <button class="btn btn-primary mt-2">Send</button>
    </x-form>
</x-layout>
