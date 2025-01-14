<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRequest extends Model
{
    use HasFactory;

    protected $casts = [
        'pending_on' => 'datetime',
        'approved_on' => 'datetime',
        'ongoing_on' => 'datetime',
        'closed_on' => 'datetime',
        'declined_on' => 'datetime'
    ];

    protected $fillable = [
        'user_id',
        'loan_user_id',
        'loan_number',
        'loan_status',
        'is_auto_debit',
        'loan_amount',
        'documentation_fee',
        'gst_on_documentation_fee',
        'up_front_charges',
        'gst_on_up_front_charges',
        'net_disbursed_amount',
        'pre_interest_amount',
        'disbursed_amount',
        'disbursed_date',
        'due_on',
        'emi_amount',
        'tenure',
        'number_of_emi',
        'total_emi_amount',
        'emi_start_date',
        'emi_end_date',
        'interest_rate',
        'post_service_fee',
        'gst_on_post_service_fee',
        'technology_fee',
        'gst_on_technology_fee',
        'loan_type',
        'payment_mode',
        'nbfc_id',
        'nbfc_name',
        'razorpay_key',
        'lender',
        'pending_on',
        'approved_on',
        'ongoing_on',
        'closed_on',
        'declined_on',
        'declined_reason'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loan_users()
    {
        return $this->belongsTo(LoanUserDetail::class, 'loan_user_id');
    }
  
    public function nbfc()
    {
        return $this->belongsTo(Nbfc::class, 'nbfc_id');
    }
}
