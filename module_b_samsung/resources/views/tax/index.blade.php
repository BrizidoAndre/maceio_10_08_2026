<x-layout>
    <h1>Tax brackets</h1>
    <a href="{{route('tax-brackets.create')}}" class="btn btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Lower bound</th>
            <th>Upper Bound</th>
            <th>Rate percent</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($models as $model)
            <tr>
                <td>{{$model->lower_bound}}</td>
                <td>{{$model->upper_bound}}</td>
                <td>{{$model->rate_percent}}</td>
                <td class="hstack gap-2">
                    <a href="{{route('tax-brackets.edit', $model)}}" class="btn btn-secondary">Update</a>
                    <x-form action="{{route('tax-brackets.destroy', $model)}}" method="delete">
                        <button class="btn btn-danger">Delete</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
