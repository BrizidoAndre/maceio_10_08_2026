@php
    $types = [
        'pending' => 'text-bg-primary',
        'approved' => 'text-bg-success',
        'rejected' => 'text-bg-danger',
        'cancelled' => 'text-bg-secondary',
]
@endphp
<span class="badge">
    {{$slot}}
</span>
