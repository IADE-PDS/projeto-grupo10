<div class="">
    <div class="dropdown dropdown-end bg-white">
        <button tabindex="0" class="btn m-1 bg-white border-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path fill="currentColor"
                    d="M4 8a6 6 0 0 1 4.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z" />
            </svg>

            @if ($notifications->count() > 0)
                <span class="badge badge-primary badge-pill">{{ $notifications->count() }}</span>
            @endif
        </button>

        {{-- Notificaçoes --}}
        <ul wire:poll.30s="refreshNotifications" tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-gray-100 rounded-box w-80">
            @if ($notifications->count() > 0)
                <li class="menu-title ">
                    <div class="flex justify-between">
                        <span class="p-1">Notificações</span>
                        <button wire:click='readAll' class="bg-[#0ED7BA] p-1 rounded-md text-white">Marcar como lido</button>
                    </div>
                </li>
                @foreach ($notifications as $notify)
                    {{-- Se a mensagem da notificação conter a palavra avalie, abre o modal "rate-modal" --}}
                    @if (Str::contains($notify->message, 'Avalie'))
                    <a x-on:click.prevent="$dispatch('open-modal', 'rate-service-modal')">
                    @else
                    <a @click="$dispatch('read-notify', { id: {{ $notify->id }} })" href="{{ route('service', ['id' => $notify->service_id]) }}" wire:navigate>
                    @endif
                        <li>
                            <span>{{ $notify->message }} - {{ $notify->created_at->diffForHumans() }}</span>
                        </li>
                    </a>
                @endforeach
            @else
                <li class="menu-title">
                    <span class="p-1">Notificações</span>
                </li>
                <li>
                    <span class="p-1 text-gray-500 text-bold ml-2">Sem notificações</span>
                </li>
            @endif
        </ul>
    </div>
    @php
        if(isset($notify)){
            $service = \App\Models\Service::find($notify->service_id);
        }
    @endphp

    <livewire:rating :service="$service"/>
</div>
