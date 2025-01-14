<?php

namespace App\Services;

use App\Services\JWEHS256Helper;
use App\Responses\Response;
use App\Constants\Constants;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BillDeskPaymentService
{
    private $pgBaseUrl;
    private $clientId;
    private $jweHelper;
    
    public function __construct($baseUrl, $clientId, $merchantKey)
    {
        $this->pgBaseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->merchantKey = $merchantKey;
        $this->jweHelper = new JWEHS256Helper($merchantKey);
    } 

    public function createOrder($request, $headers = array()) 
    {
        return $this->callPGApi(Constants::createOrderURL($this->pgBaseUrl), $request, $headers);
    }

    public function createTransaction($request, $headers = array()) 
    {
        return $this->callPGApi(Constants::createTransactionURL($this->pgBaseUrl), $request, $headers);
    }

    public function refundTransaction($request, $headers = array()) 
    {
        return $this->callPGApi(Constants::createMandateTokenURL($this->pgBaseUrl), $request, $headers);
    }

    private function callPGApi($url, $request, $headers = array([])) 
    {
        if (empty($headers[Constants::HEADER_BD_TRACE_ID])) {
            $headers[Constants::HEADER_BD_TRACE_ID] = uniqid();
        }

        $bdTraceid = $headers[Constants::HEADER_BD_TRACE_ID];

        if (empty($headers[Constants::HEADER_BD_TIMESTAMP])) {
            $headers[Constants::HEADER_BD_TIMESTAMP] = Carbon::now()->format('YmdHis');
        }

        $bdTimestamp = $headers[Constants::HEADER_BD_TIMESTAMP];

        $headers["Content-Type"] = "application/jose";
        $headers["Accept"] = "application/jose";

        $requestJson = json_encode($request);
        
        Log::info("Request to be sent to PG: " . $requestJson);
        
        $token = $this->jweHelper->encryptAndSign($requestJson, [
            Constants::JWE_HEADER_CLIENTID => $this->clientId
        ]);

        $method = "POST";

        Log::info("Sending request to PG", array(
            "url" => $url,
            "method" => $method,
            "headers" => $headers,
            "body" => $token
        ));

        $client = new Client();
        $request = new Request($method, $url, $headers, $token);
        $response = $client->send($request);
        $responseToken = $response->getBody()->getContents();

        Log::info("Response received from PG", array(
            "status" => $response->getStatusCode(),
            "body" => $responseToken
        ));
    
        $responseBody = $this->jweHelper->verifyAndDecrypt($responseToken);

        Log::info("Decrypted response from PG: " . $responseBody);

        return new Response($response->getStatusCode(), json_decode($responseBody), $bdTraceid, $bdTimestamp);
    }
}