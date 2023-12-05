@props(['name', 'message', 'time'])
<div class="chat chat-start">
    <div class="chat-header">
        {{ $name }}
        <time class="text-xs opacity-50">{{ $time->diffForHumans() }}</time>
    </div>
    <div class="chat-bubble">{{ $message }}</div>
</div>
