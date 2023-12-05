@props(['bidProp', 'service'])
<article class="p-6 m-5 text-base bg-white border rounded-lg bordered border-success">
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-xl font-semibold text-gray-900">
                {{ \App\Models\User::find($bidProp->worker_id)->name }}
            </p>
            <p class="text-sm text-gray-600">
                <time>
                    {{ $bidProp->created_at->diffForHumans() }} • {{ $bidProp->created_at->format('d/m/Y') }}
                </time>
            </p>
        </div>
        @if($service->status != "pending")
            <x-service.show.chat-dropdown :id="$service->id" />
        @endif
    </div>
    <p class="text-lg font-bold text-gray-500"> €{{ $bidProp->price/100 }} </p>
</article>
