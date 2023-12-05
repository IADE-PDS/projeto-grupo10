<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('chats')]
class Index extends Component
{
    public $service_id;

    public $messages;

    public function refresh()
    {
        $this->messages = Message::where('service_id', $this->service_id)->get();
    }

    public function mount($service_id)
    {
        $this->service_id = $service_id;

        $this->messages = Message::where('service_id', $this->service_id)->get();
    }

    public function render()
    {
        return view('livewire.chat.index');
    }
}
