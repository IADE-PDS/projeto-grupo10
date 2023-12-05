<?php

namespace App\Livewire\Notification;

use App\Models\NotificationService;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $service;

    public $notifications;

    public function mount()
    {
        $role = auth()->user()->role;

        $this->notifications = NotificationService::where($role.'_id', auth()->id())->where('read', false)->where('for', $role)->orderBy('created_at', 'desc')->get();
    }

    #[On('read-notify')]
    public function read($id)
    {
        $role = auth()->user()->role;
        $notification = NotificationService::find($id);
        $notification->read = true;
        $notification->save();

        $this->refreshNotifications();
    }

    public function readAll()
    {
        foreach ($this->notifications as $notification) {
            $notification->read = true;
            $notification->save();
        }

        $this->refreshNotifications();
    }

    public function refreshNotifications()
    {
        $role = auth()->user()->role;
        $this->notifications = NotificationService::where($role.'_id', auth()->id())->where('read', false)->where('for', $role)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.notification.index');
    }
}
