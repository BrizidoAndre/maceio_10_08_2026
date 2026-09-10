<x-layout>
    <h1>Packages</h1>
    <a href="{{route('packages.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Start_date</th>
            <th>End_date</th>
            <th>Minimum_people</th>
            <th>Partner_id</th>
            <th>Maximum_people</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Package::all() as $package)
            <tr>
                <td>{{$package->name}}</td>
                <td>{{$package->description}}</td>
                <td>{{$package->price}}</td>
                <td>{{$package->start_date->format('Y-m-d')}}</td>
                <td>{{$package->end_date->format('Y-m-d')}}</td>
                <td>{{$package->minimum_people}}</td>
                <td>{{$package->partner_id}}</td>
                <td>{{$package->maximum_people}}</td>
                <td>
                    <x-form action="{{route('packages.destroy', $package)}}" method="delete">
                        <button class="btn btn-danger">Remove</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
