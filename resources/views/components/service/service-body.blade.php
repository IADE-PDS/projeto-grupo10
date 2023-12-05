@props(['service'])
<div class="w-3/5 mt-4 mb-4 overflow-hidden bg-white rounded-lg shadow-md">
    {{-- Link para uma página isolada do serviço --}}
    <a wire:navigate href="/service/{{ $service->id }}" class="">
        {{-- Carrosel --}}
        <x-service.service-carousel  :photos="$service->photos" />

        {{-- Card com os dados do serviço --}}
        <x-service.service-card :service="$service" />
    </a>

    {{-- Input de criar lance caso seja dono do serviço --}}
    @if(auth()->user()->role == 'worker')
        <livewire:bid.create :service="$service" />
    @endif
</div>
