<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
    */

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_otp',
        'phone_number',
        'alternate_phone_number',
        'dob',
        'employment_type',
        'income_amount',
        'salary_slip',
        'bank_statement',
        'company_name',
        'company_address',
        'company_pincode',
        'company_city',
        'relationship_status',
        'selfie',
        'pan_card_number',
        'aadhaar_number',
        'current_address',
        'pincode',
        'bank_name',
        'account_number',
        'ifsc_code',
        'relative1_name',
        'relative1_relation_id',
        'relative1_phone_number',
        'relative2_name',
        'relative2_relation_id',
        'relative2_phone_number',
        'credit_limit',
        'cibil_score',
        'password',
        'my_referral_code',
        'referred_by',
        'cashback_earned',
        'is_active',
        'is_notification',
        'latitude',
        'longitude',
        'geo_location',
        'firebase_token',
        'device_id',
        'device_info',
        'jwt_token',
        'remember_token',
        'role_id',
        'user_application_status',
      	'business_enquiry_status',
        'is_defaulter',
        'defaulter_date',
        'loan_status',
        'cibil_status',
        'cibil_score_check_date',
        'loan_stage',
        'aadhaar_name',
        'aadhaar_dob',
        'aadhaar_image',
        'esign_otp',
        'esign_verification_response',
        'aadhaar_verification_response',
        'pan_name',
        'pan_verification_response',
        'selfie_verification_response',
        'cibil_score_response',
        'bank_verification_response'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function relativePersonOne()
    {
        return $this->belongsTo(Relation::class, 'relative1_relation_id');
    }

    public function relativePersonTwo()
    {
        return $this->belongsTo(Relation::class, 'relative2_relation_id');
    }
    
    public function notifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }
}
