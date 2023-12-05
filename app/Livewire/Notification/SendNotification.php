<?php

namespace App\Livewire\Notification;

use App\Models\NotificationService;

class SendNotification
{
    public static function execute(int $user_id, int $worker_id, int $service_id, string $for, string $message)
    {
        NotificationService::create([
            'client_id' => $user_id,
            'worker_id' => $worker_id,
            'service_id' => $service_id,
            'for' => $for,
            'message' => $message,
        ]);
    }
}
