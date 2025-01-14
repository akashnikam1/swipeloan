<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_amount',
        'home_screen_video_link',
        'payment_mode',
        'pincode_note',
        'version',
        'is_force_update',
        'credit_report_amount'
    ];
}
