<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\BillDeskPaymentService;

class BillDeskController extends Controller
{
    private $merchantId;
    private $clientId;
    private $secretKey;
    private $responseUrl;
    private $client;

    public function __construct()
    {
        $this->merchantId = config('services.billdesk.merchant_id');
        $this->clientId = config('services.billdesk.client_id');
        $this->secretKey = config('services.billdesk.secret_key');
        $this->client = new BillDeskPaymentService('https://api.billdesk.com', $this->clientId, $this->merchantId);
    } 

    public function createOrder(Request $request)
    {
        $initChannel = $request->init_channel;
        $ip = $request->ip;
        $userAgent = $request->user_agent;

        $request = array(
            'mercid' => $this->merchantId,
            'orderid' => uniqid(),
            'amount' => $request->amount,
            'order_date' => Carbon::now()->toW3cString(),
            'currency' => "356",
            'ru' => "https://api.billdesk.com",
            'itemcode' => "DIRECT",
            'device' => array(
                'init_channel' => $initChannel,
                'ip' => $ip,
                'user_agent' => $userAgent
            )
        );

        $response = $this->client->createOrder($request);
        $this->assertEquals(200, $response->getResponseStatus());
    }

    public function createTransaction($totalAmount)
    {
        $response = [
            'status' => true,
        ];
        
        return $response;
    }

    public function createMandateToken(Request $request)
    {

    }
}