<div x-data="{ path: '' }" x-on:modal-images.window="path = $event.detail.path">
    <x-breeze.modal x-on:close-modal="" name="full-image" focusable max-width="7xl">
        <img class="rounded-lg h-full w-full" :src="path" alt="">
    </x-breeze.modal>
</div>
