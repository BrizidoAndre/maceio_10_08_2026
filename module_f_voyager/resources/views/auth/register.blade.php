<x-layout>
    <h1>Register</h1>
    <x-form action="{{route('auth.registerAction')}}">
        <x-field name="name">Username</x-field>
        <x-field name="email" type="email">Email</x-field>
        <x-field name="password" type="password">Password</x-field>
        <x-field type="date" name="birthday">Birthday</x-field>
        <x-field name="profile_picture" type="file">Picture</x-field>
        <h2>Dependants</h2>
        @foreach(\App\Models\Customer::pluck('name','id') as $key => $customer)
            <x-check-field name="dependants[]" value="{{$key}}">{{$customer}}</x-check-field>
        @endforeach
        <button class="btn btn-primary">Send</button>w
    </x-form>
</x-layout>
