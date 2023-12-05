<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $description;

    #[Rule('required|numeric')]
    public $price;

    // #[Rule('required', message: 'Você deve enviar pelo menos uma foto.')]
    #[Rule(['photos.*' => 'required',])]
    public $photos = [];

    public $latitude;

    public $longitude;

    #[On('catch-location')]
    public function locationUpdated($lat, $long): void
    {
        $this->latitude = $lat;
        $this->longitude = $long;
    }

    public function save(): void
    {
        $this->validate();

        $proposed_price = $this->price * 100;

        if ($proposed_price > auth()->user()->balance) {
            $this->addError('price', 'Você não tem saldo suficiente para criar este serviço.');
            return;
        }

        Service::create([
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'proposed_price' => $proposed_price,
            'user_id' => auth()->id(),
        ]);

        $photos_urns = [];
        $index = 0;
        foreach ($this->photos as $photo) {
            $photos_urns[$index] = $photo->store('images/services-photos', 'public');
            $index++;
        }

        foreach ($photos_urns as $photo_urn) {
            \App\Models\ServiceImage::create([
                'service_id' => Service::latest()->first()->id,
                'path' => $photo_urn,
            ]);
        }

        $this->dispatch('close-modal');
        $this->reset();
        $this->dispatch('serviceCreated');
    }

    public function render(): View
    {
        return view('livewire.service.create');
    }
}
