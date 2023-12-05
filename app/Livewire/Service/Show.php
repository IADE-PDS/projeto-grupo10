<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public $service;

    public function mount($id)
    {
        $this->service = Service::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.service.show');
    }

    #[On('serviceUpdated')]
    public function refreshService()
    {
        $this->service = Service::findOrFail($this->service->id);
    }

    #[On('bid-accepted')]
    public function refreshWithBidAccepted()
    {
        $this->service = Service::findOrFail($this->service->id);
    }

    #[On('modal-images')]
    public function modalImages($path)
    {
        $this->dispatch('open-modal', 'full-image');
    }
}
