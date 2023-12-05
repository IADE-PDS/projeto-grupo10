@props(['service'])
<div class="">
    {{-- Se não tiver nenhum lance registrado --}}
    @if($service->status == 'pending' && auth()->user()->role === 'client' && $service->bids->count() == 0)
        <h4 class="mt-5 mb-10 ml-5 text-2xl">Nenhum lance ainda</h4>

    {{-- Se o serviço estiver pendente e for o dono do serviço --}}
    @elseif($service->status == 'pending' && auth()->user()->role === 'client')
        <h4 class="mt-5 ml-5 text-2xl">Lances</h4>
        @if($service->user_id == auth()->user()->id)
            <livewire:service.list-bid :service="$service" />
        @endif

    {{-- Se o bid foi aceito renderiza apenas ele --}}
    @elseif($service->bids->where('status', 'accepted')->count() > 0 && auth()->user()->role === 'client')
        <h4 class="mt-5 ml-5 text-2xl">Lance Aceito</h4>
        @php
            $bid = $service->bids->where('status', 'accepted')->first();
        @endphp
        <livewire:service.list-bid :service="$service" :bidProp="$bid" />

    {{-- Se for um worker só mostra o lance dele --}}
    @elseif(auth()->user()->role === 'worker' && $service->bids->where('worker_id', auth()->user()->id)->count() > 0)
        <h4 class="mt-5 ml-5 text-2xl">Seu Lance</h4>
        @php
            $bid = $service->bids->where('worker_id', auth()->user()->id)->first();
        @endphp
        <livewire:service.list-bid :service="$service" :bidProp="$bid" />
    @endif
</div>
