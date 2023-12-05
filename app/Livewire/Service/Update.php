<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Update extends Component
{
    public $service;

    public $description;

    public $price;

    public function update()
    {
        $proposed_price = $this->price * 100;

        Service::where('id', '=', $this->service->id)->update([
            'description' => $this->description,
            'proposed_price' => $proposed_price,
        ]);

        $this->dispatch('close-modal');
        $this->dispatch('serviceUpdated')->to(Show::class);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.service.update');
    }
}
