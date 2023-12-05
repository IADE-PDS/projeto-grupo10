<x-breeze.modal x-on:close-modal="" name="update-service-form" :show="$errors->isNotEmpty()" focusable max-width="sm">
    <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xlsm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
        <h3 id="modalTitle" class="text-lg font-medium leading-6 text-gray-800 capitalize">
            Editar Serviço
        </h3>
        <form enctype="multipart/form-data" class="mt-4">
            <div class="w-full max-w-xs form-control">
                <label for="description" class="label">
                    <span class="label-text text-[#444]">Descrição</span>
                </label>
                <textarea wire:model='description' id="description"
                    class="text-[#333] textarea-bordered textarea textarea-success bg-white"
                    ></textarea>
            </div>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- Price --}}
            <div class="w-full max-w-xs form-control">
                <label for="price" class="label">
                    <span class="label-text text-[#444]">Preço sugerido</span>
                </label>
                <input wire:model='price' id="price" type="number"
                    class="w-full max-w-xs bg-white input input-bordered input-success text-[#333]"/>
            </div>
            @error('price')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                <button @click="show = false" type="button" id="closeModalBtn"
                    class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                    Cancelar
                </button>

                <button wire:click='update' type="button" id="saveBtn"
                    class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-[#36D399] rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-[#3bf3b0] focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                    <span wire:loading.remove>Salvar</span>
                    <span wire:loading class="text-white loading loading-spinner loading-sm"></span>
                </button>
                <button type="hidden"></button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-modal', () => {
                // Fecha o modal
                document.getElementById('closeModalBtn').click();

                // Limpa os campos
                document.getElementById('description').value = '';
                document.getElementById('price').value = '';
                document.getElementById('codigopostal').value = '';
                document.getElementById('photos').value = '';

                // Limpa o erro do codigo postal
                document.getElementById('errorSEP').innerHTML = '';

                // Habilita o botao de salvar
                document.getElementById('saveBtn').disabled = false;
            });
        });
    </script>

</x-breeze.modal>
