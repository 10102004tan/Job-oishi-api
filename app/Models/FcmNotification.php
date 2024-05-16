<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FcmNotification extends Model
{
    use HasFactory;
    use Notifiable;

    private $fcmToken;

    public function __construct(string $fcmToken)
    {
        $this->fcmToken = $fcmToken;
    }

    public function routeNotificationForFcm()
    {
        return $this->fcmToken;
    }
}
