<?php

namespace App\Livewire\Balance;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule('required|numeric')]
    public $amount;

    public function save()
    {
        $this->validate();

        $user = User::find(auth()->user()->id);
        $user->balance += $this->amount * 100;
        $user->save();

        $this->amount = null;

        $this->dispatch('close');
        $this->dispatch('balanceUpdated');
    }

    public function render()
    {
        return view('livewire.balance.create');
    }
}
