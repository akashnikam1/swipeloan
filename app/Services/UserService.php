<?php

namespace App\Services;

use App\Models\User;
use App\Models\GeneralSetting;
use App\Models\UserOtp;
use App\Models\Notification;
use App\Jobs\SendPushNotificationJob;

class UserService
{
    protected $UserModel;
    protected $UserOTPModel;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->UserOTPModel = new UserOtp();
    }

    public function fetchRecord($data = [])
    {
        $records = [];
        
        $this->UserModel->where('role_id', 2)
            ->orderBy('id', 'DESC')
            ->chunk(1000, function ($chunk) use (&$records) {
                foreach ($chunk as $record) {
                    $records[] = $record;
                }
            });
    
        return collect($records);
    }

    public function fetch(int $user_id = 0)
    {
        return $this->UserModel->where('id', $user_id)->with('users')->first();
    }

    // OTP Implementation

    public function checkIsUserExists(array $user_data = []): ?object
    {
        if(isset($user_data['phone_number'])) {
            $user = $this->UserModel->where('phone_number', $user_data['phone_number'])->first();
        }

        if(isset($user_data['email'])) {
            $user = $this->UserModel->where('email', $user_data['email'])->first();
        }

        if (!$user) {
            $referralCode = $this->generateReferralCode();

            $referredById = null;
            $cashbackEarned = 0;

            if (isset($user_data['referral_code'])) {
                $referringUser = $this->UserModel->where('my_referral_code', $user_data['referral_code'])->first();

                if ($referringUser) {
                    $referredById = $referringUser->id;
                    $referralAmount = GeneralSetting::first();
                    $cashbackEarned = $referringUser->cashback_earned + $referralAmount->referral_amount;
                    $referringUser->update(['cashback_earned' => $cashbackEarned]);
                } 
            }

            $user = $this->UserModel->create([
                'my_referral_code' => $referralCode,
                'referred_by' => $referredById,
                'is_active' => 1
            ]);

            $optionalFields = ['first_name', 'last_name', 'email', 'phone_number', 'firebase_token'];

            foreach ($optionalFields as $field) {
                if (!empty($user_data[$field])) {
                    $user->$field = $user_data[$field];
                }
            }
            $user->save();

            // Send Welcome Notification to User

            $notificationData = Notification::find(1);

            if ($notificationData) {
                $data = [
                    'notification_id' => $notificationData['id'],
                    'title' => $notificationData['title'],
                    'description' => $notificationData['description'],
                    'image' => $notificationData['image'],
                    'user_id' => $user->id,
                    'firebase_token' => $user->firebase_token
                ];

                SendPushNotificationJob::dispatch($data);
            }
        }

        return $user;
    }

    private function generateReferralCode(): string
    {
        $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $referralCode = 'SWIPE' . $randomNumber;
        $existingReferral = $this->UserModel->where('my_referral_code', $referralCode)->exists();

        if ($existingReferral) {
            return $this->generateReferralCode();
        }
        return $referralCode;
    }

    public function insertOTP(array $user_data): ?object
    {
        $record = $this->UserOTPModel->updateOrCreate(
            [    
                'phone_number' => $user_data['phone_number'],
            ],
            [
                'phone_number' => $user_data['phone_number'],
                'otp' => $user_data['otp'],
            ]
        );

        $user = User::where('phone_number', $user_data['phone_number'])->first();
        if ($user && !empty($user_data['firebase_token'])) {
            $user->update([
                'firebase_token' => $user_data['firebase_token'],
            ]);
        }
        return $record;
    }

    public function getUserOTP($phone_number)
    {
        return $this->UserOTPModel->where('phone_number', $phone_number)->first();
    }

    public function fetchUser(int $user_id = 0)
    {
        return $this->UserModel->where('id', $user_id)->first();
    }
    
    public function updatePersonalInfo($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $user = $this->UserModel->find($id);

        $fieldsToUpdate = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'alternate_phone_number' => $data['alternate_phone_number'],    
            'dob' => $data['dob'],
            'employment_type' => $data['employment_type'],
            'relationship_status' => $data['relationship_status'],
            'current_address' => $data['current_address'],
            'pincode' => $data['pincode'],
        ];
        
        if ($user) {
            $response = $this->UserModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Personal details updated successfully.'
                ];
            }
        }
    }

    public function updateRelativeInfo($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $user = $this->UserModel->find($id);

        $fieldsToUpdate = [
            'relative1_name' => $data['relative1_name'],
            'relative1_relation_id' => $data['relative1_relation_id'],
            'relative1_phone_number' => $data['relative1_phone_number'],
            'relative2_name' => $data['relative2_name'],
            'relative2_relation_id' => $data['relative2_relation_id'],
            'relative2_phone_number' => $data['relative2_phone_number']
        ];

        if ($user) {
            $response = $this->UserModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Relative details updated successfully.'
                ];
            }
        }
    }

    public function updateLoanLimitInfo($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $user = $this->UserModel->find($id);

        $fieldsToUpdate = [
            'income_amount' => $data['income_amount'],
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'company_pincode' => $data['company_pincode'],
            'company_city' => $data['company_city'],
            'credit_limit' => $data['credit_limit'],
        ];

        // if(isset($data['salary_slip']))
        // {
        //     $fieldsToUpdate['salary_slip'] = $data['salary_slip'];
        // }

        if(isset($data['bank_statement']))
        {
            $fieldsToUpdate['bank_statement'] = $data['bank_statement'];
        }

        if ($user) {
            $response = $this->UserModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Loan limit details updated successfully.'
                ];
            }
        }
    }

    public function updateKYCInfo($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $user = $this->UserModel->find($id);

        $fieldsToUpdate = [
            'aadhaar_number' => $data['aadhaar_number'],
            'pan_card_number' => $data['pan_card_number'],
            'aadhaar_name' => $data['aadhaar_name'],
            'aadhaar_dob' => $data['aadhaar_dob'],
            'pan_name' => $data['pan_name'],
        ];

        if(isset($data['selfie']))
        {
            $fieldsToUpdate['selfie'] = $data['selfie'];
        }

        if(isset($data['aadhaar_image']))
        {
            $fieldsToUpdate['aadhaar_image'] = $data['aadhaar_image'];
        }

        if ($user) {
            $response = $this->UserModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'KYC details updated successfully.'
                ];
            }
        }
    }

    public function updateBankInfo($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $user = $this->UserModel->find($id);

        $fieldsToUpdate = [    
            'bank_name' => $data['bank_name'],
            'account_number' => $data['account_number'],
            'ifsc_code' => $data['ifsc_code']
        ];

        if ($user) {
            $response = $this->UserModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Bank details updated successfully.'
                ];
            }
        }
    }
}
