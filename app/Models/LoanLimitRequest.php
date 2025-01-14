<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLimitRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'income_amount',
        'salary_slip',
        'bank_statement',
        'company_name',
        'company_address',
        'company_pincode',
        'company_city',
        'credit_limit',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
