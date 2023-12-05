<x-app-layout>
    @if(auth()->user()->role === 'client')
    <x-slot name="header"> {{-- Slot passado para o layout --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meus Pedidos
        </h2>
    </x-slot>
    @else
    <x-slot name="header"> {{-- Slot passado para o layout --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Serviços disponíveis
        </h2>
    </x-slot>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <livewire:service>
            </div>
        </div>
    </div>
</x-app-layout>
