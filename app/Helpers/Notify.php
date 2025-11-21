<?php

namespace App\Helpers;

use App\Models\Notification;

class Notify
{
    public static function send($userId, $type, $message)
    {
        return Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'message' => $message,
            'is_read' => false
        ]);
    }
}
