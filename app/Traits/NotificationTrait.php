<?php

namespace App\Traits;

use App\Events\Notification as NotificationEvent;
use App\Models\Notification;

trait NotificationTrait {
    public function pushNotifications($user_id, $message)
    {
        Notification::create([
            'user_id' => $user_id,
            'message' => $message,
        ]);

        NotificationEvent::dispatch($user_id, $message);
    }
}
