<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nbfc extends Model
{
    use HasFactory;

    protected $fillable = [
        'nbfc_name',
        'payment_limit',
        'razorpay_key',
        'razorpay_secret',
        'razorpayX_key',
        'is_active'
    ];
}
