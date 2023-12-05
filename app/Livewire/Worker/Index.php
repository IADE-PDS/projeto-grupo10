<?php

namespace App\Livewire\Worker;

use App\Livewire\Notification\SendNotification;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $services;

    public function mount()
    {
        $this->services = Service::whereHas('bids', function ($query) {
            $query->where('worker_id', auth()->user()->id)->where('status', 'accepted');
        })->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.worker.index');
    }

    public function completeService($id): void
    {
        $service = Service::find($id);

        if ($service->status === 'completed') {
            return;
        }

        $service->status = 'completed';
        $service->save();

        $this->services = Service::whereHas('bids', function ($query) {
            $query->where('worker_id', auth()->user()->id)->where('status', 'accepted');
        })->orderBy('created_at', 'desc')->get();

        $client = User::find($service->user_id);
        $client->balance -= $service->final_price;
        $client->save();

        $worker = User::find(auth()->user()->id);
        $worker->balance += $service->final_price;
        $worker->save();

        SendNotification::execute($service->user_id, auth()->user()->id, $service->id, 'client', 'Serviço concluido, o pagamento para o trabalhador foi liberado.');

        SendNotification::execute($service->user_id, auth()->user()->id, $service->id, 'client', 'Avalie o serviço prestado pelo trabalhador.');
    }
}
