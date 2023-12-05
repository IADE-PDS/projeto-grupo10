<?php

namespace App\Livewire\Rating;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Index extends Component
{
    public $service;

    #[Rule('required')]
    public $rating;

    public function rate()
    {
        $this->validate();

        $worker_id = $this->service->bids()->where('status', 'accepted')->first()->worker_id;

        $worker = User::find($worker_id);

        $rating_count = $worker->rating_count;
        $rating = $worker->rating;

        $rating_count++;

        $rating = ($rating + $this->rating) / $rating_count;

        $rating = number_format($rating, 1);

        User::where('id', '=', $worker_id)->update([
            'rating' => $rating,
            'rating_count' => $rating_count,
        ]);

        $this->dispatch('close-modal');
        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.rating.index');
    }
}
