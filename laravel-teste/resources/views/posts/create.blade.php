<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('post.store')}}">
        <x-field name="title">Title</x-field>
        <x-field name="content">Content</x-field>
        <button class="btn btn-primary">Create</button>
    </x-form>
</x-layout>
