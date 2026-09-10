<x-layout>
    <h1>Discount</h1>
    <a href="{{route('discounts.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Package</th>
            <th>Min_people</th>
            <th>Discount</th>
            <th>Start_date</th>
            <th>End_date</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Discount::all() as $discount)
            <tr>
                <td>{{$discount->package?->name}}</td>
                <td>{{$discount->min_people}}</td>
                <td>{{$discount->discount}}%</td>
                <td>{{$discount->start_date?->format('d/m/Y')}}</td>
                <td>{{$discount->end_date?->format('d/m/Y')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
