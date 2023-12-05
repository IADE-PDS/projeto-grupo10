<?php

namespace App\Livewire\Service;

use App\Models\Service;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $services;

    public function mount()
    {
        if (auth()->user()->role === 'client') {
            $this->services = User::find(auth()->user()->id)->services->sortByDesc('created_at');
        } else {
            $this->services = Service::all()->sortByDesc('created_at');
        }
    }

    public function render()
    {
        return view('livewire.service.index');
    }

    #[On('serviceCreated')]
    public function refreshServices()
    {
        if (auth()->user()->role === 'client') {
            $this->services = User::find(auth()->user()->id)->services->sortByDesc('created_at');
        } else {
            $this->services = Service::all()->sortByDesc('created_at');
        }
    }
}
