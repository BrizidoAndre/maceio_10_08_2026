<x-layout>
    <h1>Locals</h1>
    <a href="{{route('locals.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>City</th>
            <th>Country</th>
            <th>Continent</th>
            <th>Images</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Local::all() as $local)
            <tr>
                <td>{{$local->city}}</td>
                <td>{{$local->country->country}}</td>
                <td>{{$local->country->continent}}</td>
                <td>
                    <img src="{{asset($local->images->first()->filepath ?? '')}}" alt="Image cover" width="150">
                </td>
                <td>{{$local->description}}</td>
                <td class="hstack gap-1">
                    <a href="{{route('locals.edit', $local)}}" class="btn btn-secondary">Update</a>
                    <x-form action="{{route('locals.destroy', $local)}}" method="delete">
                        <button class="btn btn-danger">Delete</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
