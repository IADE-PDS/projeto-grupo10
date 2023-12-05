<div class="p-4">
    <ul wire:poll='refresh'>
        @foreach ($messages as $message)
            @if($message->user_id == auth()->user()->id)
                <x-chat.message-end :message="$message->message" :time="$message->created_at" :name="$message->user->name"/>
            @else
                <x-chat.message-start :message="$message->message" :time="$message->created_at" :name="$message->user->name"/>
            @endif
        @endforeach
    </ul>

    <livewire:chat.create :service_id="$service_id"/>
</div>
