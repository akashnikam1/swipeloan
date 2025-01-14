<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanUserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'alternate_phone_number',
        'dob',
        'employment_type',
        'relationship_status',
        'selfie',
        'current_address',
        'pincode',
        'income_amount',
        'salary_slip',
        'bank_statement',
        'bank_name',
        'account_number',
        'ifsc_code',
        'company_name',
        'company_address',
        'company_pincode',
        'company_city',
        'credit_limit',
        'cibil_score'
    ];
}
