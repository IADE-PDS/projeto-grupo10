<x-app-layout>
    <x-slot name="header"> {{-- Slot passado para o layout --}}
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Conversas ativas
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div wire:poll class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <livewire:chat.index :service_id="$service_id"/>
            </div>
        </div>
    </div>
</x-app-layout>
