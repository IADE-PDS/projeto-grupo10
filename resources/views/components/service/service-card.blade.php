@props(['service'])
<div class="p-6">
    <div class="flex items-start justify-between sm:items-center">
        <div class="flex flex-col items-start sm:flex-row sm:items-center">
            <span class="font-semibold text-gray-700" tabindex="0" role="link">
                {{ $service->user->name }}
            </span>
            {{-- Formata a data com o carbon --}}
            <span class="text-xs text-gray-600 sm:mx-1"><span class="hidden sm:inline">•</span> {{ $service->created_at->diffForHumans() }} •
                {{ $service->created_at->format('d/m/Y') }}
            </span>
        </div>
        <div class="flex align-items">
            <x-service.maps.button/>
            <x-service.badge-status :service="$service" />
        </div>
    </div>
    <div>
        <p class="text-[0.9em] text-[#333]">
        Preço proposto: €{{ $service->proposed_price/100 }}
        @isset($service->final_price)
            • Preço final: €{{ $service->final_price/100 }}
        @endisset
        </p>
        <p class="mt-2 text-sm text-gray-600"> {{ strlen($service->description) > 200 ? substr($service->description, 0, 200) . "..." : $service->description }} </p>
    </div>
</div>