<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEnquiryStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'click_count',
        'click_dates'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
