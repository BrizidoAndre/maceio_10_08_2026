<x-layout>
    <h1>Holidays</h1>
    <a href="{{route('holidays.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($holidays as $holiday)
            <tr>
                <td>{{$holiday->name}}</td>
                <td>{{$holiday->date->format('d/m/Y')}}</td>
                <td>{{$holiday->description}}</td>
                <td>
                    <a href="{{route('holidays.edit', $holiday)}}" class="btn btn-secondary">Update</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
