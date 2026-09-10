<x-layout>
    <h1>Update</h1>
    <x-form action="{{route('post.update', $post)}}" method="put">
        <x-field value="{{$post->title}}" name="title">Title</x-field>
        <x-field value="{{$post->content}}" name="content">Content</x-field>
        <button class="btn btn-primary">Create</button>
    </x-form>
</x-layout>
