<div class="">
    @if(auth()->user()->role === 'client')
        <p x-on:click.prevent="$dispatch('open-modal', 'user-balance-modal')"
        class="text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out
        bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none cursor-pointer">
        €{{ $amount }}
        </p>
    @else
        <p class="text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out
        bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
            €{{ $amount }}
        </p>
    @endif

    <livewire:balance.create>
</div>
