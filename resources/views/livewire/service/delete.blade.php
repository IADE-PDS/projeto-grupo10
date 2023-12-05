<x-breeze.modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
    <form wire:submit="delete" class="p-6">
        <h2 class="text-lg text-center font-medium text-gray-900">
            <p>Você tem certeza que deseja deletar o serviço?</p>
        </h2>

        <div class="mt-6 flex justify-center">
            <x-breeze.secondary-button x-on:click="$dispatch('close')">
                <span>Cancelar</span>
            </x-breeze.secondary-button>

            <x-breeze.danger-button  class="ml-3">
                <span wire:loading.remove>Deletar Serviço</span>
                <span wire:loading class="loading loading-spinner loading-md"></span>
            </x-breeze.danger-button>
        </div>
    </form>
</x-breeze.modal>
