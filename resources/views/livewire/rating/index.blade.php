<x-breeze.modal name="rate-service-modal" :show="$errors->isNotEmpty()" focusable>
    <form wire:submit="rate" class="p-6 flex flex-col items-center">
        <h2 class="text-lg text-center font-medium text-gray-900">
            <p>Avalie o serviço prestado pelo trabalhador</p>
        </h2>

        <div class="form-control">
            <label class="label cursor-pointer justify-start">
                <input wire:model='rating' value="5" type="radio" name="radio-1" class="radio radio-accent" />
                <span class="label-text ml-4">Excelente</span>
            </label>
            <label class="label cursor-pointer justify-start">
                <input wire:model='rating' value="4" type="radio" name="radio-1" class="radio radio-success" />
                <span class="label-text ml-4">Bom</span>
            </label>
            <label class="label cursor-pointer justify-start">
                <input wire:model='rating' value="3" type="radio" name="radio-1" class="radio radio-info" />
                <span class="label-text ml-4">Regular</span>
            </label>
            <label class="label cursor-pointer justify-start">
                <input wire:model='rating' value="2" type="radio" name="radio-1" class="radio radio-warning" />
                <span class="label-text ml-4">Ruim</span>
            </label>
            <label class="label cursor-pointer justify-start">
                <input wire:model='rating' value="1" type="radio" name="radio-1" class="radio radio-error" />
                <span class="label-text ml-4">Muito ruim</span>
            </label>
        </div>

        @error('rating')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
        @enderror


        <div class="mt-6 flex justify-center">
            <x-breeze.secondary-button x-on:click="$dispatch('close')" id="closeModalBtn">
                <span>Cancelar</span>
            </x-breeze.secondary-button>

            <x-breeze.success-button  class="ml-3">
                <span wire:loading.remove>Confirmar</span>
                <span wire:loading class="loading loading-spinner loading-md"></span>
            </x-breeze.success-button>
        </div>
    </form>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('close-modal', () => {
                // Fecha o modal
                document.getElementById('closeModalBtn').click();
            });
        });
    </script>
</x-breeze.modal>
