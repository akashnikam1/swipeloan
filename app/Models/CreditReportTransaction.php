<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditReportTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'payment_amount',
        'payment_mode',
        'payment_date',
        'status',
        'payment_response'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
