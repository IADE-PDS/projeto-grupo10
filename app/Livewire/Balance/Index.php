<?php

namespace App\Livewire\Balance;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $amount;

    public function mount()
    {
        $this->amount = auth()->user()->balance / 100;
    }

    #[On('balanceUpdated')]
    public function updateBalance()
    {
        $this->amount = auth()->user()->balance / 100;
    }

    public function render()
    {
        return view('livewire.balance.index');
    }
}
