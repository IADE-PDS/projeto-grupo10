@props(['service'])

@php
    $statusClass = [
        'pending' => 'warning',
        'accepted' => 'info',
        'rejected' => 'error',
        'completed' => 'success',
    ][$service->status] ?? 'secondary';
@endphp

<span
    @class([
        'badge',
        'uppercase',
        'badge-warning' => $service->status === 'pending',
        'badge-info' => $service->status === 'accepted',
        'badge-error' => $service->status === 'rejected',
        'badge-success' => $service->status === 'completed',
    ])>
    {{ucfirst($service->status)}}
</span>
