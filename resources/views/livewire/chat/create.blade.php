<div class="m-2">
    <div class="relative">
        {{-- Price --}}
        <input wire:model='messageContent' type="text" id="chatMessage" class="block w-full p-4 pl-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Digite sua mensagem" required>
        {{-- Action button --}}
        <button wire:click='sendMessage' class="text-white absolute right-2.5 bottom-2 bg-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3.402 6.673c-.26-2.334 2.143-4.048 4.266-3.042l11.944 5.658c2.288 1.083 2.288 4.339 0 5.422L7.668 20.37c-2.123 1.006-4.525-.708-4.266-3.042L3.882 13H12a1 1 0 1 0 0-2H3.883l-.48-4.327Z" clip-rule="evenodd"/></svg>
        </button>
    </div>

    @error('messageContent')
        <span class="ml-4 text-sm text-red-500 font-bold">{{ $message }}</span>
    @enderror
</div>
