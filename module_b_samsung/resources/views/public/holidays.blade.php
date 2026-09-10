<x-layout :title="'Public Holidays ' . now()->format('Y')">
    <h1>Holidays</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        @foreach($holidays as $holiday)
            <tr class="{{$holiday->date->isBefore(now()) ? 'opacity-25' : ''}}">
                <td>{{$holiday->name}}</td>
                <td>{{$holiday->date->format('l, d F Y')}}</td>
                <td>{{$holiday->description}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
