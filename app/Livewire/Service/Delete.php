<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;

class Delete extends Component
{
    public $service;

    public function delete()
    {
        $service = Service::findOrFail($this->service->id);

        if ($service->photos) {
            foreach ($service->photos as $photo) {
                Storage::disk('public')->delete($photo->path);
                $photo->delete();
            }
        }

        $service->delete();

        return redirect()->to(route('dashboard'));
    }

    public function render(): View
    {
        return view('livewire.service.delete');
    }
}
