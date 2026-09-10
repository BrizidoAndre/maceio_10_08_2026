<x-layout>
    <h1>Posts</h1>
    <a href="{{route('post.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td class="hstack gap-1">
                    <a href="{{route('post.edit', $post)}}" class="btn btn-secondary">Edit</a>
                    <x-form method="delete" action="{{route('post.destroy', $post)}}">
                        <button class="btn btn-danger">Delete</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
