<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\BusinessHelper;
use App\Helpers\PaymentHelper;
use App\Http\Controllers\BillDeskController;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Jobs\SendPushNotificationJob;
use App\Models\CreditReportTransaction;
use App\Models\ENachTransaction;
use App\Models\GeneralSetting;
use App\Models\LoanRequest;
use App\Models\LoanStage;
use App\Models\Nbfc;
use App\Models\Payment;
use App\Models\User;
use App\Services\BillDeskService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JWTAuth;

class PaymentApiController extends Controller
{
    protected $razorpayKey;
    protected $razorpaySecret;
    protected $billDeskService;
    protected $surePassApiToken;

    public function __construct(Request $request = null)
    {
        $nbfcId = null;
        $paymentId = null;

        if ($request) {
            $nbfcId = $request->nbfc_id;
            $paymentId = $request->payment_id;
        }

        if ($nbfcId) {
            $nbfc = Nbfc::find($nbfcId);

            if ($nbfc) {
                $this->razorpayKey = $nbfc->razorpay_key;
                $this->razorpaySecret = $nbfc->razorpay_secret;
            }
        }

        if ($paymentId) {
            $payment = Payment::find($paymentId);

            if ($payment) {
                $loanRequest = LoanRequest::find($payment->loan_id);

                if ($loanRequest) {
                    $nbfc = Nbfc::find($loanRequest->nbfc_id);

                    if ($nbfc) {
                        $this->razorpayKey = $nbfc->razorpay_key;
                        $this->razorpaySecret = $nbfc->razorpay_secret;
                    }
                }
            }
        }

        if(!$nbfcId && !$paymentId) {
            $this->razorpayKey = BusinessHelper::getBusinessInfo('razorpay_key');
            $this->razorpaySecret = BusinessHelper::getBusinessInfo('razorpay_secret');
        }

        $this->surePassApiToken = BusinessHelper::getBusinessInfo('surepass_api_token');
        $this->billDeskService = new BillDeskService();
    }

    // Razorpay Payment Gateway Integration

    public function razorpayWebhookResponse(Request $request)
    {
        Log::channel('daily')->info('Razorpay Webhook received:', $request->all());

        $webhookData = [
            'data' => json_encode($request->all()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('razorpay_webhook_response')->insert($webhookData);
    }

    public function createOrderId(Request $request)
    {
        $request->validate([
            'payment_id' => 'required',
            'total_amount' => 'required',
        ]);

        $businessSetting = GeneralSetting::find(1);

        if ($businessSetting->payment_mode == 1) {
            return $this->createOrder($request);
        } else {
            return $this->createBillDeskOrderId($request);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            $paymentId = $request->payment_id;
            $totalAmount = $request->total_amount;
            $payment = Payment::find($paymentId);

            $client = new Client();

            $response = $client->request('POST', 'https://api.razorpay.com/v1/orders', [
                'auth' => [
                    $this->razorpayKey,
                    $this->razorpaySecret,
                ],
                'json' => [
                    'amount' => $totalAmount * 100,
                    'currency' => 'INR',
                    'receipt' => (string) $payment->id,
                ],
            ]);

            $razorpayOrderResponse = json_decode($response->getBody(), true);
            $orderId = $razorpayOrderResponse['id'];
            $currency = $razorpayOrderResponse['currency'];

            $payment->order_id = $orderId;
            $payment->save();

            $data = [
                'payment_id' => $paymentId,
                'id' => $orderId,
                'total_amount' => $totalAmount,
                'currency' => $currency,
                'payment_mode' => 1,
            ];

            return response()->json([
                'status' => true,
                'message' => 'Order Id created successfully',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create order Id', 'error' => $e->getMessage()], 500);
        }
    }

    private function createBillDeskOrderId($request)
    {
        $paymentId = $request->payment_id;
        $payment = Payment::find($paymentId);
        $totalAmount = $request->total_amount;

        $token = JWTAuth::parseToken();
        $userId = $token->getPayload()->get('sub');
        $user = User::find($userId);
        $deviceInfo = json_decode($user->device_info, true);

        $merchantId = 'UATKGILF';
        $orderId = Str::random(15);
        $orderDate = Carbon::now()->format('Y-m-d\TH:i:sP');
        $name = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
        $phoneNumber = $user->phone_number;

        $payload = [
            'mercid' => $merchantId,
            'orderid' => $orderId,
            'amount' => $totalAmount,
            'order_date' => $orderDate,
            'currency' => '356',
            'ru' => 'https://www.merchant.com/',
            'itemcode' => 'DIRECT',
            'additional_info' => [
                'additional_info1' => $name,
                'additional_info2' => $phoneNumber,
                'additional_info3' => $email,
            ],
            'device' => [
                'init_channel' => $deviceInfo['init_channel'],
                'ip' => $deviceInfo['ip'],
                'user_agent' => $deviceInfo['user_agent'],
                'accept_header' => 'text/html',
            ],
        ];

        $encodedData = $this->billDeskService->encodeAndSign($payload);

        $bdTraceId = $this->generateTraceId();
        $bdTimestamp = now()->format('YmdHis');

        $headers = [
            'Accept' => 'application/jose',
            'Content-Type' => 'application/jose',
            'BD-Timestamp' => $bdTimestamp,
            'BD-Traceid' => $bdTraceId,
        ];

        try {
            $client = new Client();

            $response = $client->post('https://uat1.billdesk.com/u2/payments/ve1_2/orders/create', [
                'headers' => $headers,
                'body' => $encodedData,
            ]);

            $responseBody = $response->getBody()->getContents();
            $decodedResponse = (array) $this->billDeskService->decode($responseBody);
            $data = array_merge(['payment_id' => $paymentId, 'payment_mode' => 2], $decodedResponse);

            if ($decodedResponse['status'] === 'ACTIVE') {
                $bOrderId = $decodedResponse['bdorderid'];

                if ($payment) {
                    $payment->order_id = $bOrderId;
                    $payment->save();
                }
                return response()->json(['status' => true, 'message' => 'Order id created successfully', 'data' => $data], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Order id not created', 'data' => $data], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create billdesk order id', 'error' => $e->getMessage()], 500);
        }
    }

    public function razorpayPaymentStatus(Request $request)
    {
        try {
            $paymentId = $request->payment_id;
            $paymentStatus = $request->payment_status;
            $paymentResponse = $request->payment_response;

            $payment = Payment::find($paymentId);
            $orderId = $payment->order_id;

            if ($paymentStatus == 'failed') {
                // $payment->previous_order_id = $orderId;
                $payment->payment_response = $paymentResponse;
                $payment->save();

                return response()->json(['status' => false, 'message' => 'Payment transaction failed'], 200);
            }

            if ($paymentStatus == 'success') {
                $response = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode($this->razorpayKey . ':' . $this->razorpaySecret),
                    'Content-Type' => 'application/json',
                ])->get("https://api.razorpay.com/v1/orders/{$orderId}/payments");

                if ($response->successful()) {
                    $responseData = $response->json();

                    $transactionId = null;

                    if (isset($responseData['items'][0]['acquirer_data']) && is_array($responseData['items'][0]['acquirer_data'])) {
                        $acquirerData = $responseData['items'][0]['acquirer_data'];

                        $transactionIdKey = null;
                        $transactionIdValue = null;

                        foreach ($acquirerData as $key => $value) {
                            if (strpos($key, 'transaction_id') !== false) {
                                $transactionIdKey = $key;
                                $transactionIdValue = $value;
                                break;
                            }
                        }

                        if ($transactionIdKey !== null && $transactionIdValue !== null) {
                            $transactionId = $transactionIdValue;
                        }

                        if ($transactionId === null) {
                            $transactionId = $acquirerData['auth_code'] ?? null;
                        }
                    }

                    $this->updatePaymentStatus($payment, $paymentResponse, $transactionId, $orderId);
                }

                return response()->json(['status' => true, 'message' => 'Payment done successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to pay EMI', 'error' => $e->getMessage()], 500);
        }
    }

    public function fetchPaymentStatus($payment)
    {
        try {
            $orderId = $payment->order_id;

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->razorpayKey . ':' . $this->razorpaySecret),
                'Content-Type' => 'application/json',
            ])->get("https://api.razorpay.com/v1/orders/{$orderId}/payments");

            if ($response->successful()) {
                $paymentResponse = $response->json();
                $responseData = json_encode($paymentResponse);

                if (isset($paymentResponse['items']) && count($paymentResponse['items']) > 0) {
                    $paymentResp = $paymentResponse['items'][0];

                    if ($paymentResp['status'] == 'captured') {
                        $acquirerData = $paymentResp['acquirer_data'];

                        $transactionIdKey = null;
                        $transactionIdValue = null;
                        $transactionId = null;

                        foreach ($acquirerData as $key => $value) {
                            if (strpos($key, 'transaction_id') !== false) {
                                $transactionIdKey = $key;
                                $transactionIdValue = $value;
                                break;
                            }
                        }

                        if ($transactionIdKey !== null && $transactionIdValue !== null) {
                            $transactionId = $transactionIdValue;
                        }

                        if ($transactionId === null) {
                            $transactionId = $acquirerData['auth_code'] ?? null;
                        }

                        $this->updatePaymentStatus($payment, $responseData, $transactionId, $orderId);
                    } else {
                        $payment->previous_order_id = $orderId;
                        $payment->payment_response = $responseData;
                        $payment->save();
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch payment status', 'error' => $e->getMessage()], 500);
        }
    }

    private function updatePaymentStatus($payment, $paymentResponse, $transactionId, $orderId)
    {
        $amount = $payment->payment_amount;
        $eNachCharges = $payment->enach_charges;
        $gstOnENachCharges = $payment->gst_on_enach_charges;
        $bounceCharges = $payment->bounce_charges;

        $today = Carbon::today();
        $currentDateTime = Carbon::now();
        $currentDateWithTime = $currentDateTime->format('Y-m-d H:i:s');

        $lastPayment = Payment::where('user_id', $payment->user_id)
            ->where('status', 0)
            ->orderBy('payment_date', 'desc')
            ->first();

        $loanRequest = LoanRequest::where('id', $payment->loan_id)->first();
        $user = User::where('id', $payment->user_id)->first();

        if ($lastPayment && $payment->id == $lastPayment->id) {
            if ($loanRequest) {
                $loanRequest->loan_status = 3;
                $loanRequest->closed_on = $currentDateWithTime;
                $loanRequest->save();
            }

            if ($user) {
                $email = $user->email;
                $data = [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'subject' => "Congratulations! Your Loan is Successfully Completed",
                    'lines_count' => 3,
                    'content_line1' => "We are delighted to inform you that your loan has been successfully completed. We appreciate your commitment and timely payments throughout the loan tenure.",
                    'content_line2' => "We would like to extend our gratitude for choosing us. It has been a pleasure serving you, and we hope to assist you with your future financial endeavors. You will recieve NOC to registered email within a 1 month.",
                    'content_line3' => "Thank you for choosing us for your financial needs.",
                ];

                SendEmailJob::dispatch($email, $data);

                // Increase User Loan Stage

                $loanStageCount = LoanStage::where('is_active', 1)->count();

                $user->loan_status = 0;

                if ($user->loan_stage > 3) {
                    $currentLoanStage = LoanStage::where('id', $user->loan_stage)->first();

                    if ($currentLoanStage) {
                        $loanAmount = $currentLoanStage->amount;

                        $loanRequestCount = LoanRequest::where('user_id', $user->id)
                            ->where('loan_amount', $loanAmount)
                            ->count();

                        if ($loanRequestCount >= 2) {
                            if ($user->loan_stage < $loanStageCount) {
                                $user->loan_stage = $user->loan_stage + 1;
                            }
                        }
                    }
                } else {
                    if ($user->loan_stage < $loanStageCount) {
                        $user->loan_stage = $user->loan_stage + 1;
                    }
                }

                $user->save();
            }
        }

        if ($lastPayment && $payment->id != $lastPayment->id) {
            $paymentDate = $payment->payment_date;
            $dueDate = Carbon::parse($paymentDate)->addDays(14);
            $loanRequest->due_on = $dueDate->format('Y-m-d');
            $loanRequest->save();
        }

        ENachTransaction::create([
            'payment_id' => $payment->id,
            'amount' => $amount,
            'enach_charges' => $eNachCharges,
            'gst_on_enach_charges' => $gstOnENachCharges,
            'bounce_charges' => $bounceCharges,
            'enach_status' => 1,
            'is_enach' => 0,
            'enach_date' => $today,
            'enach_response' => $paymentResponse,
        ]);

        $payment->previous_order_id = $orderId;
        $payment->transaction_id = $transactionId;
        $payment->payment_mode = "Razorpay";
        $payment->status = 1;
        $payment->payment_completed_date = $currentDateWithTime;
        $payment->payment_response = $paymentResponse;
        $payment->save();
    }

    // Billdesk Payment Gateway Integration

    public function billdeskWebhookResponse(Request $request)
    {
        Log::channel('daily')->info('Billdesk Webhook received:', $request->all());

        $webhookData = [
            'data' => json_encode($request->all()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('billdesk_webhook_response')->insert($webhookData);
    }

    public function createBilldeskPaymentOrder(Request $request)
    {
        $billdesk = new BillDeskController();
        $billdesk->createOrder($request);
    }

    public function payEmiNow(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $paymentId = $request->payment_id;
            $payment = Payment::find($paymentId);

            $emiCharges = PaymentHelper::calculateEMIBounceCharges($payment);
            $amount = $payment->payment_amount;
            $eNachCharges = $emiCharges['enach_charges'];
            $gstOnENachCharges = $emiCharges['gst_on_enach_charges'];
            $bounceCharges = $emiCharges['bounce_charges'];
            $totalAmount = $emiCharges['total_amount'];

            $billdesk = new BillDeskController();
            $billdesk->createTransaction($totalAmount);

            $response = [];

            if ($response['status'] === false) {
                $payment->payment_response = $response;
                $payment->save();

                return response()->json(['status' => false, 'message' => 'Payment transaction failed'], 200);
            }

            if ($response['status'] === true) {
                $today = Carbon::today();
                $paymentDate = Carbon::parse($today)->format('d-m-Y');
                $currentDateTime = Carbon::now();
                $currentDateWithTime = $currentDateTime->format('Y-m-d H:i:s');

                $lastPayment = Payment::where('user_id', $payment->user_id)
                    ->orderBy('payment_date', 'desc')
                    ->first();

                $loanRequest = LoanRequest::where('id', $payment->loan_id)->first();

                if ($lastPayment && $payment->id === $lastPayment->id) {
                    if ($loanRequest) {
                        $loanRequest->loan_status = 3;
                        $loanRequest->closed_on = $currentDateWithTime;
                        $loanRequest->save();
                    }

                    $user = User::where('id', $payment->user_id)->get();
                    $email = $user->email;
                    $data = [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'subject' => "Congratulations! Your Loan is Successfully Completed",
                        'lines_count' => 3,
                        'content_line1' => "We are delighted to inform you that your loan has been successfully completed. We appreciate your commitment and timely payments throughout the loan tenure.",
                        'content_line2' => "We would like to extend our gratitude for choosing us. It has been a pleasure serving you, and we hope to assist you with your future financial endeavors. You will recieve NOC to registered email within a 1 month.",
                        'content_line3' => "Thank you for choosing us for your financial needs.",
                    ];

                    SendEmailJob::dispatch($email, $data);

                    $notificationData = [
                        'notification_id' => '',
                        'title' => 'Loan is Successfully Completed',
                        'description' => 'Hello ' . $user->first_name . ', We are delighted to inform you that your loan has been successfully completed.',
                        'image' => '',
                        'user_id' => $user->id,
                        'firebase_token' => $user->firebase_token,
                    ];

                    SendPushNotificationJob::dispatch($notificationData);

                    if ($user) {
                        $loanStageCount = LoanStage::where('is_active', 1)->count();

                        $user->loan_status = 0;

                        if ($user->loan_stage > 3) {
                            $currentLoanStage = LoanStage::where('id', $user->loan_stage)->first();

                            if ($currentLoanStage) {
                                $loanAmount = $currentLoanStage->amount;

                                $loanRequestCount = LoanRequest::where('user_id', $user->id)
                                    ->where('loan_amount', $loanAmount)
                                    ->count();

                                if ($loanRequestCount >= 2) {
                                    if ($user->loan_stage < $loanStageCount) {
                                        $user->loan_stage = $user->loan_stage + 1;
                                    }
                                }
                            }
                        } else {
                            if ($user->loan_stage < $loanStageCount) {
                                $user->loan_stage = $user->loan_stage + 1;
                            }
                        }

                        $user->save();
                    }
                }

                if ($lastPayment && $payment->id !== $lastPayment->id) {
                    $paymentDate = $payment->payment_date;
                    $dueDate = Carbon::parse($paymentDate)->addDays(14);
                    $loanRequest->due_on = $dueDate->format('Y-m-d');
                    $loanRequest->save();
                }

                $data = [
                    'notification_id' => '',
                    'title' => 'EMI is deducted',
                    'description' => 'Hello ' . $user->first_name . ', Your EMI is deducted.',
                    'image' => '',
                    'user_id' => $user->id,
                    'firebase_token' => $user->firebase_token,
                ];

                SendPushNotificationJob::dispatch($data);

                ENachTransaction::create([
                    'payment_id' => $payment->id,
                    'amount' => $amount,
                    'enach_charges' => $eNachCharges,
                    'gst_on_enach_charges' => $gstOnENachCharges,
                    'bounce_charges' => $bounceCharges,
                    'enach_status' => 1,
                    'is_enach' => 0,
                    'enach_date' => $today,
                    'enach_response' => $response,
                ]);

                $payment->transaction_id = $response['transaction_id'];
                $payment->enach_charges = $eNachCharges;
                $payment->gst_on_enach_charges = $gstOnENachCharges;
                $payment->bounce_charges = $bounceCharges;
                $payment->total_amount = $totalAmount;
                $payment->payment_mode = "Billdesk";
                $payment->status = 1;
                $payment->payment_completed_date = $currentDateWithTime;
                $payment->payment_response = $response;
                $payment->save();

                return response()->json(['status' => true, 'message' => 'Payment done successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to pay EMI', 'error' => $e->getMessage()], 500);
        }
    }

    // Payout - Disbursed Loan Amount

    public function disburseLoanAmount($user, $disbursedAmount)
    {
        try {
            $client = new Client();

            // Step 1: Create Contact
            $contactResponse = $client->request('POST', 'https://api.razorpay.com/v1/contacts', [
                'auth' => [
                    $this->razorpayKey,
                    $this->razorpaySecret,
                ],
                'json' => [
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'contact' => $user->phone_number,
                    'type' => 'customer',
                    'reference_id' => 'Acme Contact ID ' . uniqid(),
                    'notes' => [
                        'payout_message' => 'Payout of INR ' . $disbursedAmount,
                    ],
                ],
            ]);

            $contactData = json_decode($contactResponse->getBody(), true);

            if (!isset($contactData['id']) || !$contactData['active']) {
                return response()->json(['status' => false, 'message' => 'Failed to create contact']);
            }

            $contactId = $contactData['id'];

            // Step 2: Create Fund Account
            $fundAccountResponse = $client->request('POST', 'https://api.razorpay.com/v1/fund_accounts', [
                'auth' => [
                    $this->razorpayKey,
                    $this->razorpaySecret,
                ],
                'json' => [
                    'contact_id' => $contactId,
                    'account_type' => 'bank_account',
                    'bank_account' => [
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'ifsc' => $user->ifscCode,
                        'account_number' => $user->accountNumber,
                    ],
                ],
            ]);

            $fundAccountData = json_decode($fundAccountResponse->getBody(), true);

            if (!isset($fundAccountData['id']) || !$fundAccountData['active']) {
                return response()->json(['status' => false, 'message' => 'Failed to create fund account']);
            }

            $fundAccountId = $fundAccountData['id'];

            // Step 3: Create Payout
            $payoutResponse = $client->request('POST', 'https://api.razorpay.com/v1/payouts', [
                'auth' => [
                    $this->razorpayKey,
                    $this->razorpaySecret,
                ],
                'json' => [
                    'account_number' => '7878780080316316',
                    'fund_account_id' => $fundAccountId,
                    'amount' => $disbursedAmount * 100,
                    'currency' => 'INR',
                    'mode' => 'IMPS',
                    'purpose' => 'refund',
                    'queue_if_low_balance' => true,
                    'reference_id' => 'Acme Transaction ID ' . uniqid(),
                    'narration' => 'Loan Disbursement',
                    'notes' => [
                        'notes_key_1' => 'Payout for loan disbursement',
                        'notes_key_2' => 'Amount: INR ' . $disbursedAmount,
                    ],
                ],
                'headers' => [
                    'X-Payout-Idempotency' => uniqid(),
                    'Content-Type' => 'application/json',
                ],
            ]);

            $payoutData = json_decode($payoutResponse->getBody(), true);

            if (!isset($payoutData['id'])) {
                return response()->json(['status' => false, 'message' => 'Failed to create payout']);
            }

            return response()->json(['status' => true, 'message' => 'Loan amount disbursed successfully']);
        } catch (ClientException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Client error occurred',
            ]);
        } catch (ServerException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error occurred',
            ]);
        } catch (RequestException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Request error occurred',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred',
            ]);
        }
    }

    public function createCreditReportOrderId(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');

            $paymentAmount = $request->payment_amount;
            $client = new Client();

            $response = $client->request('POST', 'https://api.razorpay.com/v1/orders', [
                'auth' => [
                    $this->razorpayKey,
                    $this->razorpaySecret,
                ],
                'json' => [
                    'amount' => $paymentAmount * 100,
                    'currency' => 'INR',
                    'receipt' => 'receipt_' . Str::random(32),
                ],
            ]);

            $razorpayOrderResponse = json_decode($response->getBody(), true);
            $orderId = $razorpayOrderResponse['id'];
            $currency = $razorpayOrderResponse['currency'];

            CreditReportTransaction::create([
                'user_id' => $userId,
                'order_id' => $orderId,
                'payment_amount' => $paymentAmount,
                'payment_date' => Carbon::now(),
            ]);

            $data = [
                'id' => $orderId,
                'payment_amount' => $paymentAmount,
                'currency' => $currency,
            ];

            return response()->json([
                'status' => true,
                'message' => 'Order Id created successfully',
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to create order Id', 'error' => $e->getMessage()], 500);
        }
    }

    public function razorpayCreditReportPaymentStatus(Request $request)
    {
        try {
            $token = JWTAuth::parseToken();
            $userId = $token->getPayload()->get('sub');
            $user = User::find($userId);

            $orderId = $request->order_id;
            $creditReportTransaction = CreditReportTransaction::where('order_id', $orderId)->first();

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->razorpayKey . ':' . $this->razorpaySecret),
                'Content-Type' => 'application/json',
            ])->get("https://api.razorpay.com/v1/orders/{$orderId}/payments");

            if ($response->successful()) {
                $paymentResponse = $response->json();
                $responseData = json_encode($paymentResponse);

                if (isset($paymentResponse['items']) && count($paymentResponse['items']) > 0) {
                    $paymentResp = $paymentResponse['items'][0];

                    if ($paymentResp['status'] == 'captured') {
                        $acquirerData = $paymentResp['acquirer_data'];

                        $transactionIdKey = null;
                        $transactionIdValue = null;
                        $transactionId = null;

                        foreach ($acquirerData as $key => $value) {
                            if (strpos($key, 'transaction_id') !== false) {
                                $transactionIdKey = $key;
                                $transactionIdValue = $value;
                                break;
                            }
                        }

                        if ($transactionIdKey !== null && $transactionIdValue !== null) {
                            $transactionId = $transactionIdValue;
                        }

                        if ($transactionId === null) {
                            $transactionId = $acquirerData['auth_code'] ?? null;
                        }

                        $creditReportTransaction->transaction_id = $transactionId;
                        $creditReportTransaction->payment_mode = 'RAZORPAY';
                        $creditReportTransaction->status = 1;
                        $creditReportTransaction->payment_response = $responseData;
                        $creditReportTransaction->save();

                        // Sent Credit Report

                        $name = $user->first_name . ' ' . $user->last_name;    
                        $panNumber = $user->pan_card_number;
                        $consent = 'Y';
                        $mobile = $user->phone_number;

                        $client = new Client();

                        $response = $client->request('POST', 'https://kyc-api.surepass.io/api/v1/credit-report-experian/fetch-report-pdf', [
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
                        $creditReportLink = $response['data']['credit_report_link'];

                        $data = [
                            'credit_report_link' => $creditReportLink
                        ];

                        return response()->json(['status' => true, 'message' => 'Credit report downloaded successfully', 'data' => $data], 200);
                    } else {
                        $creditReportTransaction->payment_response = $responseData;
                        $creditReportTransaction->save();

                        return response()->json(['status' => false, 'message' => 'Payment failed'], 200);
                    }
                }

                return response()->json(['status' => false, 'message' => 'Payment failed'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch payment status', 'error' => $e->getMessage()], 500);
        }
    }

    private function generateTraceId($length = 35)
    {
        $length = min($length, 35);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $traceId = '';

        for ($i = 0; $i < $length; $i++) {
            $traceId .= $characters[rand(0, $charactersLength - 1)];
        }

        return $traceId;
    }
}
