<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('tax-brackets.store')}}">
        <x-field name="lower_bound">
            Lower bound
        </x-field>

        <x-field name="upper_bound">
            Upper bound
        </x-field>

        <x-field name="rate_percent">
            Rate percent
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
