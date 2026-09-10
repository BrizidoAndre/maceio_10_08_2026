@php
    $alerts = [
        'danger',
        'primary',
        'secondary',
        'success',
        'warning',
]
@endphp
<div class="position-fixed bottom-0 end-0 m-5">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
    @foreach($alerts as $alert)
        @session($alert)
        <div class="alert alert-{{$alert}} alert-dismissible fade show" role="alert">
            {{$value}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endsession
    @endforeach
</div>
