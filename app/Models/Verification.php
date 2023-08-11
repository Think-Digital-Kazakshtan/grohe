<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\SendPhoneVerificationNotification;

class Verification extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded = [];

    public function send(): void
    {
        $this->notify(new SendPhoneVerificationNotification($this->otp));
    }
}