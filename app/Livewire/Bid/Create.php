<?php

namespace App\Livewire\Bid;

use App\Livewire\Notification\SendNotification;
use App\Models\Bid;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $service; //Prop

    #[Rule('required|numeric|min:1|max:1000000')]
    public $price;

    public function save()
    {
        $this->validate();

        if (Bid::where('service_id', $this->service->id)->where('worker_id', auth()->id())->exists()) {
            $this->addError('price', 'Você já fez uma proposta para este serviço');

            return;
        }

        if ($this->service->status != 'pending') {
            $this->addError('price', 'Este serviço já foi aceito por outro trabalhador');

            return;
        }

        Bid::create([
            'service_id' => $this->service->id,
            'worker_id' => auth()->id(),
            'price' => $this->price * 100,
        ]);

        $this->redirect('/service/'.$this->service->id);

        SendNotification::execute($this->service->user_id, auth()->id(), $this->service->id, 'client', 'Nova proposta');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.bid.create');
    }
}
