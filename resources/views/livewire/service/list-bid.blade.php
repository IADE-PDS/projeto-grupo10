<div class="">
    @empty($bidProp)
        @foreach ($service->bids as $bid)
        <article class="p-6 m-5 text-base bg-white border rounded-lg bordered border-warning">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-xl font-semibold text-gray-900">
                        {{ \App\Models\User::find($bid->worker_id)->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <time>
                            {{ $bid->created_at->diffForHumans() }} • {{ $bid->created_at->format('d/m/Y') }}
                        </time>
                    </p>
                </div>
            </div>
            <p class="text-[0.9em] mt-[-10px] text-[#333]">Nota: {{ \App\Models\User::find($bid->worker_id)->rating }}</p>
            <p class="text-lg font-bold text-gray-500"> €{{ $bid->price/100 }} </p>
            <div class="flex items-center mt-4 space-x-4">
                <div class="join">
                    <button wire:click='accept({{ $bid->id }})' class="btn btn-success join-item">Aceitar</button>
                </div>
            </div>
        </article>
        @endforeach
    @endempty
    @isset($bidProp)
        <x-service.bid :bidProp="$bidProp" :service="$service"/>
    @endisset
</div>
