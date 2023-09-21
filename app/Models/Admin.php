<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User //user for aithentications
{
    use HasFactory , HasApiTokens, Notifiable, TwoFactorAuthenticatable;

    public function devices()
    {
        return $this->morphMany(DeviceToken::class,'tokenable');
    }
}
