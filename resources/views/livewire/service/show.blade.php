<div class="py-10">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="relative">
                {{-- Dropdown --}}
                @if($service->user_id === auth()->user()->id)
                    <x-service.show.config-dropdown :service="$service" />
                @endif

                {{-- Carrosel com as fotos --}}
                <x-service.service-carousel :photos="$service->photos" />

                {{-- Corpo com os dados --}}
                <x-service.show.card :service="$service" />
            </div>

            @if(auth()->user()->role == 'worker' && $service->status === 'pending')
                <livewire:bid.create :service="$service" />
            @endif

            {{-- Lista os bids se for o dono do serviço --}}
            <x-service.show.bids-logic :service="$service" />
        </div>
    </div>

    <livewire:service.delete :service="$service" />
    <livewire:service.update :service="$service" />
    <x-service.maps.modal :service="$service" />

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('serviceUpdated', () => {
                location.reload();
            });

            Livewire.on('bid-accepted', () => {
                location.reload();
            });
        });
    </script>
</div>
</div>
