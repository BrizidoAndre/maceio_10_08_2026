<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('holidays.store')}}">
        <x-field name="name">
            Name
        </x-field>
        <x-field name="date" type="date">
            Date
        </x-field>
        <x-field name="description">
            Description
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
