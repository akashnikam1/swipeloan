<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\BusinessHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification as NotificationApp;
use App\Models\LoanRequest;
use App\Jobs\GenerateLoanDocumentsJob;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Carbon\Carbon;
use App\Jobs\SendPushNotificationJob;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;

class VerificationApiController extends Controller
{
    protected $surePassApiToken;

    public function __construct()
    {
        $this->surePassApiToken = BusinessHelper::getBusinessInfo('surepass_api_token');
    }

    // Bank Verification

    public function saveBankDetails(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub'); 
            $user = User::find($userId);

            $phoneNumber = $user->phone_number;
            $name = $user->first_name . ' ' . $user->last_name;
            $bankName = $request->bank_name;
            $accountNumber = $request->account_number;
            $ifscCode = $request->ifsc_code;

            $client = new Client();

            $response = $client->request('POST', 'https://api.cashfree.com/verification/bank-account/sync', [
                'json' => [
                    'bank_account' => $accountNumber,
                    'ifsc' => $ifscCode,
                    'name' => $name,
                    'phone' => $phoneNumber,
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'x-client-id' => config('services.cashfree.client_id'),
                    'x-client-secret' => config('services.cashfree.client_secret')
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            $user->bank_name = $bankName;
            $user->account_number = $accountNumber;
            $user->ifsc_code = $ifscCode;
            $user->bank_verification_response = json_encode($responseData);
            $user->save();

            if($responseData['account_status'] == "VALID")
            {
                $user->user_application_status = 3;
                $user->save();

                $message = 'Bank account verify successfully';
                return response()->json(['status' => true, 'message' => $message], 200);
            } 

            $accountStatusMessages = [
                "INVALID_ACCOUNT_FAIL" => 'Bank account is invalid',
                "ACCOUNT_BLOCKED" => 'Bank account is blocked',
                "INVALID_IFSC_FAIL" => 'IFSC code is invalid',
                "NRE_ACCOUNT_FAIL" => 'Bank account NRE failed',
            ];

            $message = $accountStatusMessages[$responseData['account_status_code']];

            return response()->json(['status' => false, 'message' => $message], 200);
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);

            if($errorResponse['code'] == "imps_mode_fail")
            {
                return response()->json(['status' => false, 'message'=> 'Bank account is invalid'], 200);
            }

            if($statusCode === 500)
            {
                return response()->json(['status' => false, 'message'=> $errorResponse['message']], 500);
            }

            return response()->json(['status' => false, 'message'=> $errorResponse['message']], 200);
        }
    }

    // E-Sign Verification

    public function sendEsignOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
            $aadhaarNumber = $request->aadhaar_number;

            if($aadhaarNumber != $user->aadhaar_number) {
                return response()->json([
                    'ref_id' => '',
                    'status' => false,
                    'message' => 'Your aadhaar number does not match with KYC aadhaar number'
                ], 200);
            }

            $client = new Client();

            try {
                $response = $client->request('POST', 'https://api.cashfree.com/verification/offline-aadhaar/otp', [
                    'json' => [
                        'aadhaar_number' => $aadhaarNumber,
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                        'x-client-id' => config('services.cashfree.client_id'),
                        'x-client-secret' => config('services.cashfree.client_secret')
                    ],
                ]);

                $responseData = json_decode($response->getBody(), true);

                if($responseData['status'] === 'INVALID')
                {
                    return response()->json([
                        'ref_id' => $responseData['ref_id'],
                        'status' => false,
                        'message' => $responseData['message']
                    ], 200);
                }

                return response()->json([
                    'ref_id' => $responseData['ref_id'],
                    'status' => true,
                    'message' => $responseData['message']
                ], 200);
            } catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                $refId = isset($errorResponse['refId']) ? $errorResponse['refId'] : '';

                if($statusCode === 500)
                {
                    return response()->json([
                        'ref_id'=> isset($errorResponse['error']['refId']) ? $errorResponse['error']['refId'] : '',
                        'status'=> false,
                        'message'=> $errorResponse['message']
                    ], 500);
                }

                return response()->json([
                    'ref_id'=> $refId,
                    'status' => false,
                    'message'=> $errorResponse['message']
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to send OTP for e-sign', 'error' => $e->getMessage()], 500);
        }
    }

    public function verifyEsignOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
            $otp = $request->otp;
            $refId = $request->ref_id;

            $client = new Client();

            try {
                $response = $client->request('POST', 'https://api.cashfree.com/verification/offline-aadhaar/verify', [
                    'json' => [
                        'otp' => $otp,
                        'ref_id' => $refId
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                        'x-client-id' => config('services.cashfree.client_id'),
                        'x-client-secret' => config('services.cashfree.client_secret')
                    ],
                ]);

                $verificationResponse = json_decode($response->getBody(), true);
                
                $user->loan_status = 1;
                $user->esign_otp = $otp;
                $user->esign_verification_response = json_encode($verificationResponse);
                $user->save();

                $loanRequest = LoanRequest::where('user_id', $userId)->where('loan_status', 0)->first();

                if($loanRequest) {
                    $loanRequest->loan_status = 1;
                    $loanRequest->approved_on = Carbon::now()->format('Y-m-d H:i:s');
                    $loanRequest->save();
        
                    $loanId = $loanRequest->id;                  
                    GenerateLoanDocumentsJob::dispatch($loanId);

                    $notificationData = NotificationApp::find(2);
                    $data = [
                        'notification_id' => $notificationData['id'],
                        'title' => $notificationData['title'],
                        'description' => $notificationData['description'],
                        'image' => $notificationData['image'],
                        'user_id' => $user->id,
                        'firebase_token' => $user->firebase_token
                    ];
                    
                    SendPushNotificationJob::dispatch($data);

                    $email = "info@swipeloan.in";
                    $data = [
                        'first_name' => 'Admin',
                        'last_name' => '',
                        'subject' => "Loan Application Approved for Loan Number $loanRequest->loan_number",
                        'lines_count' => 5,
                        'content_line1' => "The loan application for the following user has been approved:",
                        'content_line2' => "Name: $user->first_name $user->last_name",
                        'content_line3' => "Loan Number: $loanRequest->loan_number",
                        'content_line4' => "Loan Amount: $loanRequest->disbursed_amount",
                        'content_line5' => "Please proceed with the disbursement of the amount.",
                    ];

                    SendEmailJob::dispatch($email, $data);             
                }
    
                return response()->json([
                    'ref_id'=> $verificationResponse['ref_id'],
                    'status'=> true,
                    'message'=> 'Loan approved successfully'
                ], 200);
            } catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                $refId = isset($errorResponse['error']['refId']) ? $errorResponse['error']['refId'] :
                (isset($errorResponse['refId']) ? $errorResponse['refId'] : '');

                if($statusCode === 500)
                {
                    if($errorResponse['code'] === 'verification_failed')
                    {
                        return response()->json([
                            'ref_id'=> $refId,
                            'status'=> false,
                            'message'=> 'Please enter a valid otp.'
                        ], 200);
                    }

                    return response()->json([
                        'ref_id'=> $refId,
                        'status'=> false,
                        'message'=> $errorResponse['message']
                    ], 500);
                }

                return response()->json([
                    'ref_id'=> $refId,
                    'status'=> false,
                    'message'=> $errorResponse['message']
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to verify OTP for e-sign', 'error' => $e->getMessage()], 500);
        }
    }

    // Aadhaar Verification

    public function sendAadhaarOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $aadhaarNumber = $request->aadhaar_number;
            $client = new Client();

            try {
                $existingUser = User::where('aadhaar_number', $aadhaarNumber)
                    ->where('id', '!=', $userId)
                    ->first();

                if ($existingUser) {
                    $maskedPhoneNumber = str_repeat('*', strlen($existingUser->phone_number) - 4) . substr($existingUser->phone_number, -4);

                    return response()->json([
                        'ref_id' => null,
                        'status' => false,
                        'message' => "The Aadhaar number is already linked. You can login with the phone number ending with $maskedPhoneNumber",
                    ], 200);
                }
                
                $response = $client->request('POST', 'https://api.cashfree.com/verification/offline-aadhaar/otp', [
                    'json' => [
                        'aadhaar_number' => $aadhaarNumber,
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                        'x-client-id' => config('services.cashfree.client_id'),
                        'x-client-secret' => config('services.cashfree.client_secret')
                    ],
                ]);

                $responseData = json_decode($response->getBody(), true);

                if($responseData['status'] === 'INVALID')
                {
                    return response()->json([
                        'ref_id' => $responseData['ref_id'],
                        'status' => false,
                        'message' => $responseData['message']
                    ], 200);
                }

                $user->aadhaar_number = $aadhaarNumber;
                $user->save();

                return response()->json([
                    'ref_id' => $responseData['ref_id'],
                    'status' => true,
                    'message' => $responseData['message']
                ], 200);
            } catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                $refId = isset($errorResponse['refId']) ? $errorResponse['refId'] : '';

                if($statusCode === 500)
                {
                    return response()->json([
                        'ref_id'=> isset($errorResponse['error']['refId']) ? $errorResponse['error']['refId'] : '',
                        'status'=> false,
                        'message'=> $errorResponse['message']
                    ], 500);
                }

                return response()->json([
                    'ref_id'=> $refId,
                    'status' => false,
                    'message'=> $errorResponse['message']
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to send aadhaar OTP', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function verifyAadhaarOtp(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $otp = $request->otp;
            $refId = $request->ref_id;
            $client = new Client();

            try {
                $response = $client->request('POST', 'https://api.cashfree.com/verification/offline-aadhaar/verify', [
                    'json' => [
                        'otp' => $otp,
                        'ref_id' => $refId
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                        'x-client-id' => config('services.cashfree.client_id'),
                        'x-client-secret' => config('services.cashfree.client_secret')
                    ],
                ]);

                $verificationResponse = json_decode($response->getBody(), true);

                $imageUrl = $verificationResponse['photo_link'];
                $base64_string = preg_replace('/^data:image\/\w+;base64,/', '', $imageUrl);
                $imageContents = base64_decode($base64_string);

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $imageMimeType = finfo_buffer($finfo, $imageContents);
                finfo_close($finfo);
                $extension = explode('/', $imageMimeType)[1];

                $number = rand(1111111, 999999);
                $imageName = 'AadhaarImages/' . $userId . '_' . $number . '.' . $extension;
                Storage::disk('public')->put($imageName, $imageContents);

                $user->aadhaar_name = $verificationResponse['name'];
                $user->aadhaar_dob = Carbon::createFromFormat('d-m-Y', $verificationResponse['dob'])->format('Y-m-d');
                $user->aadhaar_image = $imageName;
                $user->aadhaar_verification_response = json_encode($verificationResponse);
                $user->save();

                return response()->json([
                    'ref_id'=> $verificationResponse['ref_id'],
                    'status'=> true,
                    'message'=> 'Aadhaar verify successfully'
                ], 200);
            } catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);

                $refId = isset($errorResponse['error']['refId']) ? $errorResponse['error']['refId'] :
                (isset($errorResponse['refId']) ? $errorResponse['refId'] : '');

                if($statusCode === 500)
                {
                    if($errorResponse['code'] === 'verification_failed')
                    {
                        return response()->json([
                            'ref_id'=> $refId,
                            'status'=> false,
                            'message'=> 'Please enter a valid otp'
                        ], 200);
                    }

                    return response()->json([
                        'ref_id'=> $refId,
                        'status'=> false,
                        'message'=> $errorResponse['message']
                    ], 500);
                }

                return response()->json([
                    'ref_id'=> $refId,
                    'status'=> false,
                    'message'=> $errorResponse['message']
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to verify aadhaar OTP', 'error' => $e->getMessage()], 500);
        }
    }

    // PAN Verification

    public function verifyPanCard(Request $request)
    {
        try {
            $pan = $request->pan;
            $name = $request->name;
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $client = new Client();

            try {
                $existingUser = User::where('pan_card_number', $pan)
                    ->where('id', '!=', $userId)
                    ->first();

                if ($existingUser) {
                    $maskedPhoneNumber = str_repeat('*', strlen($existingUser->phone_number) - 4) . substr($existingUser->phone_number, -4);

                    return response()->json([
                        'status' => false,
                        'message' => "The PAN number is already linked. You can login with the phone number ending with $maskedPhoneNumber",
                    ], 200);
                }
                
                $response = $client->request('POST', 'https://api.cashfree.com/verification/pan', [
                    'json' => [
                        'pan' => $pan,
                        'name' => $name
                    ],
                    'headers' => [
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                        'x-client-id' => config('services.cashfree.client_id'),
                        'x-client-secret' => config('services.cashfree.client_secret')
                    ],
                ]);

                $verificationResponse = json_decode($response->getBody(), true);

                if ($verificationResponse['valid'] === false) {
                    return response()->json([
                        'status'=> false,
                        'message'=> $verificationResponse['message']
                    ], 200);
                }

                $user->pan_card_number = $pan;
                $user->pan_name = $verificationResponse['registered_name'];
                $user->pan_verification_response = json_encode($verificationResponse);
                $user->save();

                try {
                    $name = $user->first_name . ' ' . $user->last_name;    
                    $panNumber = $user->pan_card_number;
                    $consent = 'Y';
                    $mobile = $user->phone_number;

                    $client = new Client();

                    $response = $client->request('POST', 'https://kyc-api.surepass.io/api/v1/credit-report-experian/fetch-report', [
                        'json' => [
                            'name' => $name,
                            'consent' => $consent,
                            'mobile' => $mobile,
                            'pan' => $panNumber
                        ],
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Bearer ' . $this->surePassApiToken,
                        ],
                    ]);
            
                    $response = json_decode($response->getBody(), true);

                    $creditScore = intval($response['data']['credit_score']);
                    $user->cibil_score = $creditScore;
                    ($creditScore > 600) ? $user->cibil_status = 1 : 0;
                    $user->cibil_score_response = json_encode($response);
                    $user->cibil_score_check_date = now();
                    $user->save();
                } catch (RequestException $e) {
                    $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
                    $user->cibil_score_response = json_encode($errorResponse);
                    $user->cibil_score_check_date = now();
                    $user->save();
                }

                return response()->json([
                    'status' => true,
                    'message' => $verificationResponse['message']
                ], 200);
            } catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);

                if($statusCode === 500)
                {
                    return response()->json([
                        'status'=> false,
                        'message'=> $errorResponse['message']
                    ], 500);
                }

                return response()->json([
                    'status'=> false,
                    'message'=> $errorResponse['message']
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to verify PAN', 'error' => $e->getMessage()], 500);
        }
    }

    // Selfie Verification

    public function verifySelfie(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $cibilScore = $user->cibil_score;

            $randomLength = rand(8, 50);
            $verificationId = $this->generateUniqueId($randomLength);

            $firstImage = $request->file('first_image');
            $firstImageContents = file_get_contents($firstImage->getRealPath());
            $firstImageMimeType = $firstImage->getMimeType();
            $firstImageName = $firstImage->getClientOriginalName();

            $secondImage = $user->aadhaar_image;
            $secondImageContents = Storage::get('public/' . $secondImage);
            $secondImageMimeType = mime_content_type(storage_path('app/public/' . $secondImage));
            $secondImageName = basename($secondImage);

            $client = new Client();

            $response = $client->request('POST', 'https://api.cashfree.com/verification/face-match', [
                'multipart' => [
                    [
                        'name' => 'verification_id',
                        'contents' => $verificationId
                    ],
                    [
                        'name' => 'threshold',
                        'contents' => '0.7'
                    ],
                    [
                        'name' => 'first_image',
                        'filename' => $firstImageName,
                        'contents' => $firstImageContents,
                        'headers' => [
                                'Content-Type' => $firstImageMimeType
                            ]
                    ],
                    [
                        'name' => 'second_image',
                        'filename' => $secondImageName,
                        'contents' => $secondImageContents,
                        'headers' => [
                                'Content-Type' => $secondImageMimeType
                            ]
                    ],
                    [
                        'name' => 'detect_mask_first_image',
                        'contents' => 'true'
                    ],
                    [
                        'name' => 'detect_mask_second_image',
                        'contents' => 'true'
                    ]
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'x-client-id' => config('services.cashfree.client_id'),
                    'x-client-secret' => config('services.cashfree.client_secret')
                ],
            ]);

            $verificationResponse = json_decode($response->getBody(), true);

            if ($verificationResponse['face_match_result'] === 'NO') {
                return response()->json([
                    'status' => false,
                    'message' => 'Aadhaar photo and Selfie do not match',
                ], 200);
            }

            $selfiePath = null;
            if ($request->hasFile('first_image')) {
                if ($user && $user->selfie) {
                    Storage::delete('public/' . $user->selfie);
                }

                $selfie = $request->file('first_image');
                $number = rand(1111111, 999999);
                $selfiePath = "UserProfile/Selfies/Selfie{$number}." . $selfie->getClientOriginalExtension();
                Storage::putFileAs('public', $selfie, $selfiePath);
            }

            $aadhaarName = $user->aadhaar_name;
            $aadhaarDob = $user->aadhaar_dob;
            $panName = $user->pan_name;
            $dob = $user->dob;

            $aadhaarDobFormatted = Carbon::createFromFormat('Y-m-d', $aadhaarDob)->format('d-m-Y');
            $dobFormatted = Carbon::createFromFormat('Y-m-d', $dob)->format('d-m-Y');

            if ((strcasecmp($aadhaarName, $panName) !== 0) && ($aadhaarDob !== $dob)) {
                $message = "Aadhaar and PAN details do not match";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ], 200);
            }

            if (strcasecmp($aadhaarName, $panName) !== 0) {
                $message = "Aadhaar name ({$aadhaarName}) and PAN name ({$panName}) do not match";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ], 200);
            }

            if ($aadhaarDob !== $dob) {
                $message = "Aadhaar date of birth ({$aadhaarDobFormatted}) and profile date of birth ({$dobFormatted}) do not match";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ], 200);
            }
            
            if ($cibilScore <= 600) {
                $message = "Oops! Your CIBIL score is less than 600. Please try after 3 months";
                return response()->json([
                    'status' => false,
                    'message' => $message
                ], 200);
            }

            $user->user_application_status = 2;
            $user->selfie = $selfiePath;
            $user->selfie_verification_response = $verificationResponse;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Aadhaar, PAN and Selfie verify successfully'
            ], 200);
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);

            if($statusCode === 500)
            {
                return response()->json([
                    'status'=> false,
                    'message'=> $errorResponse['message']
                ], 500);
            }

            return response()->json([
                'status'=> false,
                'message'=> $errorResponse['message']
            ], 200);
        }
    }
    
    // Save Bank Statement PDF

    public function saveBankStatement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'flag' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);
    
            $sessionId = $request->session_id;
            $flag = $request->flag;
    
            if ($sessionId != null) {
                $apiUrl1 = "https://apis.bankconnect.finbox.in/bank-connect/v1/session_data/{$sessionId}/initiate_processing/";
                $apiUrl2 = "https://apis.bankconnect.finbox.in/bank-connect/v1/session_data/{$sessionId}/session_status/";
                $apiUrl3 = "https://apis.bankconnect.finbox.in/bank-connect/v1/session_data/{$sessionId}/get_pdfs/";
    
                $headers = [
                    'x-api-key' => 'orBZsW2dwwaswlosqbCovaTTzWoVMxjYAl5IwCwB',
                    'server-hash' => 'a6bcc809fbba40bb89945fc7f566ab6a',
                ];
    
                $client = new Client();
    
                $initiateProcessingResponse = $client->request('POST', $apiUrl1, [
                    'headers' => $headers,
                ]);
    
                if ($initiateProcessingResponse->getStatusCode() === 202) {
                    $pollingTimeout = 300;
                    $pollingInterval = 10;
                    $elapsedTime = 0;
    
                    while ($elapsedTime < $pollingTimeout) {
                        try {
                            $statusResponse = $client->request('GET', $apiUrl2, [
                                'headers' => $headers,
                            ]);
    
                            if ($statusResponse->getStatusCode() === 200) {
                                $responseBody = json_decode($statusResponse->getBody()->getContents(), true);
    
                                if (isset($responseBody['accounts']) && count($responseBody['accounts']) > 0) {
                                    if($flag == 'instaFund') {
                                        $accountNumberFromResponse = $responseBody['accounts'][0]['account_number'];
                                        $bankNameFromResponse = $responseBody['accounts'][0]['bank_name'];
        
                                        $userAccountNumber = $user->account_number;
                                        $userBankName = $user->bank_name;
        
                                        if (($accountNumberFromResponse != $userAccountNumber)) {
                                            return response()->json([
                                                'status' => false,
                                                'is_modal' => true,
                                                'message' => 'Account number or bank name does not match with Bank statement. Do you want to change the account details?',
                                            ], 200);
                                        }
                                    }
        
                                    $response = $client->request('GET', $apiUrl3, [
                                        'headers' => $headers,
                                    ]);
    
                                    $responseBody = json_decode($response->getBody()->getContents(), true);
                                    $successfulStatement = collect($responseBody['statements'])->firstWhere('message', 'Success');
    
                                    if ($successfulStatement) {
                                        $pdfUrl = $successfulStatement['pdf_url'];
                                        $pdfContent = Http::get($pdfUrl);
    
                                        if ($pdfContent->successful()) {
                                            $number = rand(1111111, 999999);
    
                                            if ($flag == 'business') {
                                                $filePath = "BusinessEnquiry/BankStatements/BankStatement{$number}.pdf";
                                            } else {
                                                $filePath = "UserProfile/BankStatements/BankStatement{$number}.pdf";
                                                $user->bank_statement = $filePath;
                                                $user->save();
                                            }
    
                                            Storage::put("public/{$filePath}", $pdfContent->body());
                                        }
                                    }
    
                                    return response()->json([
                                        'status' => true,
                                        'message' => 'Bank statement saved successfully',
                                        'data' => $filePath,
                                    ], 200);
                                }
                            }
                        } catch (RequestException $e) {
                            $statusCode = $e->getResponse()->getStatusCode();
    
                            if ($statusCode === 400) {
                                sleep($pollingInterval);
                                $elapsedTime += $pollingInterval;
                                continue;
                            }
    
                            if ($statusCode === 503) {
                                sleep($pollingInterval);
                                $elapsedTime += $pollingInterval;
                                continue;
                            }
    
                            throw $e;
                        }
    
                        sleep($pollingInterval);
                        $elapsedTime += $pollingInterval;
                    }
    
                    return response()->json([
                        'status' => false,
                        'message' => 'Processing not completed within the expected time frame',
                    ], 200);
                }
    
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot proceed as the processing has not been requested yet',
                ], 200);
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Session ID is missing or invalid.',
            ], 200);
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
    
            if ($statusCode === 500) {
                return response()->json([
                    'status' => false,
                    'message' => $errorResponse['error']['message'] ?? 'Internal server error.',
                ], 500);
            }
    
            return response()->json([
                'status' => false,
                'message' => $errorResponse['error']['message'] ?? 'An error occurred.',
            ], 200);
        }
    }

    private function generateUniqueId($length = 50)
    {
        $length = min($length, 50);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-_';
        $charactersLength = strlen($characters);
        $uniqueId = '';
        for ($i = 0; $i < $length; $i++) {
            $uniqueId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $uniqueId;
    }
}
