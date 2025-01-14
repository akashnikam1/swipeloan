<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLoanRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age_of_applicant',
        'consitution_of_applicant',
        'type_of_bank_account',
        'office_ownership',
        'residence_ownership',
        'business_vintage',
        'bank_statement',
        'shop_act',
        'itr',
        'gstin',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
