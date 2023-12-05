<div wire:poll.30s='refreshServices'  class="flex flex-col items-center justify-center w-full">
    @if ($services->isEmpty() && auth()->user()->role === 'client')
        <div class="p-6 text-gray-900">
            Você ainda não tem nenhum serviço!
        </div>
    @endif

    @foreach ($services as $service)
        @if (auth()->user()->role === 'worker' && $service->status !== 'pending')
            @continue
        @endif

        {{-- Corpo com todo o serviço --}}
        <x-service.service-body :service="$service" />
    @endforeach

    {{-- Só o client pode criar posts --}}
    @if (auth()->user()->role === 'client')
        <livewire:service.create>
    @endif
</div>
