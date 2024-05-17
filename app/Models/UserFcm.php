<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFcm extends Model
{
    use HasFactory;

    protected $table = 'users_device';

    protected $fillable = [
        'user_id',
        'fcm_token',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
