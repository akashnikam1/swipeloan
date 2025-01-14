<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'payment_date' => 'date:Y-m-d',
        'payment_completed_date' => 'datetime',
    ];

    protected $fillable = [
        'transaction_id',
        'order_id',
        'previous_order_id',
        'payment_amount',
        'enach_charges',
        'gst_on_enach_charges',
        'bounce_charges',
        'total_amount',
        'payment_mode',
        'payment_date',
        'user_id',
        'loan_id',
        'status',
        'payment_completed_date',
        'payment_response'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loans()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_id');
    }
}
