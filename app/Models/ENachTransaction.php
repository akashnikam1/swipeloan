<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ENachTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'amount',
        'enach_charges',
        'gst_on_enach_charges',
        'bounce_charges',
        'enach_status',
        'is_enach',
        'enach_date',
        'enach_response'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
