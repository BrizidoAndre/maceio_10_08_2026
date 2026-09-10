<x-layout>
    <h1>Update</h1>
    <x-form action="{{route('tax-brackets.update', $taxBracket)}}" method="put">
        <x-field name="lower_bound" value="{{$taxBracket->lower_bound}}">
            Lower bound
        </x-field>

        <x-field name="upper_bound" value="{{$taxBracket->upper_bound}}">
            Upper bound
        </x-field>

        <x-field name="rate_percent" value="{{$taxBracket->rate_percent}}">
            Rate percent
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
