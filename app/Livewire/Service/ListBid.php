<?php

namespace App\Livewire\Service;

use App\Livewire\Notification\SendNotification;
use Livewire\Component;

class ListBid extends Component
{
    public $service;

    public $bidProp = null;

    public function accept($bidId)
    {
        $bid = $this->service->bids()->where('id', $bidId)->first();

        $bid->update([
            'status' => 'accepted',
        ]);

        $this->service->update(
            ['status' => 'accepted',
                'final_price' => $bid->price,
            ]);

        $this->service->bids()->where('id', '!=', $bidId)->update([
            'status' => 'rejected',
        ]);

        SendNotification::execute($this->service->user_id, $bid->worker_id, $this->service->id, 'worker', 'Proposta aceita, entre em contato com o cliente, para combinar os detalhes da prestação do serviço.');

        $this->dispatch('bid-accepted');
    }

    public function render()
    {
        return view('livewire.service.list-bid');
    }
}
