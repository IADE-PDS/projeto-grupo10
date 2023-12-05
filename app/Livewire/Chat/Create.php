<?php

namespace App\Livewire\Chat;

use App\Livewire\Notification\SendNotification;
use App\Models\Message;
use App\Models\Service;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    public $service_id;

    public $service;

    #[Rule('required|min:1|max:255')]
    public $messageContent;

    public function mount($service_id)
    {
        $this->service_id = $service_id;
        $this->service = Service::find($service_id);
    }

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'service_id' => $this->service_id,
            'user_id' => auth()->id(),
            'message' => $this->messageContent,
        ]);

        $this->messageContent = '';

        $client_id = $this->service->user_id;
        $worker_id = $this->service->bids()->where('status', 'accepted')->first()->worker_id;

        if (auth()->user()->role === 'worker') {
            SendNotification::execute(
                $client_id,
                $worker_id,
                $this->service_id,
                'client',
                'Você tem uma nova mensagem de: '.auth()->user()->name
            );
        } else {
            SendNotification::execute(
                $client_id,
                $worker_id,
                $this->service_id,
                'worker',
                'Você tem uma nova mensagem de: '.auth()->user()->name
            );
        }

        $this->dispatch('newMessage')->to(Index::class);
    }

    public function render()
    {
        return view('livewire.chat.create');
    }
}
