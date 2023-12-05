<div>
    <div x-data="{ isOpen: false, uploading: false }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        class="relative flex justify-center">
        <button id="openModalButton" @click="isOpen = true"
            class="fixed w-14 h-14 bottom-8 right-10 bg-[#818CF8] text-white rounded-full text-center text-3xl shadow-md z-50">
            +
        </button>

        <div x-show="isOpen" x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95" x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100" x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100" x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

                <div
                    class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xlsm:my-8 sm:w-full sm:max-w-sm sm:p-6 sm:align-middle">
                    <h3 id="modalTitle" class="text-lg font-medium leading-6 text-gray-800 capitalize">
                        Solicitar um serviço
                    </h3>

                    <form enctype="multipart/form-data" class="mt-4">
                        <div class="w-full max-w-xs form-control">
                            <label for="description" class="label">
                                <span class="label-text text-[#444]">Descrição</span>
                            </label>
                            <textarea wire:model='description' id="description"
                                class="text-[#333] textarea-bordered textarea textarea-success bg-white">
                            </textarea>
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
                                class="w-full max-w-xs bg-white input input-bordered input-success text-[#333]" />
                        </div>
                        @error('price')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        {{-- SEP --}}
                        <div class="w-full max-w-xs form-control">
                            <label class="label">
                                <span class="label-text text-[#444]">Código Postal</span>
                            </label>
                            <input x-mask="9999999" id="codigopostal" type="number" placeholder="0000-000"
                                class="w-full max-w-xs bg-white input input-bordered input-success text-[#333]" />
                        </div>
                        <span id="errorSEP" class="text-red-500">

                        </span>

                        {{-- Photos --}}
                        <div 
                            x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="photos" class="label">
                                <span class="label-text text-[#444]">Fotos do veículo (Até 5 imagens)</span>
                            </label>
                            <input wire:model='photos' multiple required id="photos" type="file"
                                class="mt-4 w-full max-w-xs file-input file-input-bordered file-input-success" />
                            <div x-show="uploading">
                                <progress class="progress progress-success w-56" max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                        @error('photos')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        {{-- Actions Buttons --}}
                        <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                            <button @click="isOpen = false" type="button" id="closeModalBtn"
                                class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                Cancelar
                            </button>
                            <button wire:click='save' type="button" id="saveBtn"
                                class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-[#36D399] rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-[#3bf3b0] focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                <span wire:loading.remove>Salvar</span>
                                <span wire:loading class="text-white loading loading-spinner loading-sm"></span>
                            </button>
                            <button type="hidden"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        var $codigoPostal = document.getElementById('codigopostal');
        var $errorSEP = document.getElementById('errorSEP');
        $codigoPostal.addEventListener('input', function() {
            var codigoPostal = $codigoPostal.value;

            var api = `https://json.geoapi.pt/codigo_postal/${codigoPostal}?campos=latitude,longitude`

            if(codigoPostal.length < 7) return;

            fetch(api)
                .then(response => response.json())
                .then(data => {
                    var lat = data.centro[0];
                    var long = data.centro[1];
                    // // Envia os dados para o backend
                    Livewire.dispatch('catch-location', {
                        lat: lat,
                        long: long
                    });
                })
                .catch(error => {
                    $errorSEP.innerHTML = 'Código Postal inválido';
                    // Bloqueia o botao de salvar
                    document.getElementById('saveBtn').disabled = true;
                })
        });
    </script>
</div>
