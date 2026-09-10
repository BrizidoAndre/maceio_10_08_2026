<x-layout>
    <h1>Update</h1>
    <x-form action="{{route('holidays.update', $holiday)}}" method="put">
        <x-field name="name" value="{{$holiday->name}}">
            Name
        </x-field>
        <x-field name="date" type="date" value="{{$holiday->date->format('Y-m-d')}}">
            Date
        </x-field>
        <x-field name="description" value="{{$holiday->description}}">
            Description
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
