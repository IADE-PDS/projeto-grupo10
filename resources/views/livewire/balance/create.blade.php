<x-breeze.modal name="user-balance-modal" focusable>
    <form wire:submit="save" class="p-6">
        <h2 class="text-lg text-center font-medium text-gray-900">
            Adicionar valor a carteira
        </h2>

        <div class="mt-6 flex justify-center">
            <div class="w-full max-w-xs form-control">
                <label for="amount" class="label">
                    <span class="label-text text-[#444]">Valor</span>
                </label>
                <input wire:model='amount' id="amount" type="number"
                    class="w-full max-w-xs bg-white input input-bordered input-success text-[#333]" />
            </div>
            @error('amount')
              <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-6 flex justify-center">
            <button type="submit" class="btn btn-primary w-full max-w-xs">Adicionar</button>
        </div>
    </form>
</x-breeze.modal>
