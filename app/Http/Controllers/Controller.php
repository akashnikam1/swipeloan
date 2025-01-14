<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Google\Auth\Credentials\ServiceAccountCredentials;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendPushNotification($notification = [])
    {	
        $accessToken = $this->getAccessToken();

        $imageUrl = $notification['image'] ? asset('storage/app/public/'.$notification['image']) : '';
        
        $data = [
            "message" => [
                "token" => !empty($notification['firebase_token']) ? $notification['firebase_token'] : [],
                "notification" => [
                    "title" => $notification['title'],
                    "body" => $notification['description'],
                    "image" => $imageUrl
                ],
                "data" => [
                    "title" => $notification['title'],
                    "body" => $notification['description'],
                    "image" => $imageUrl,
                ],
                "android" => [
                    "notification" => [
                        "image" => $imageUrl,
                    ],
                ],
                "apns" => [
                    "payload" => [
                        "aps" => [
                            "mutable-content" => 1,
                        ],
                    ],
                    "fcm_options" => [
                        "image" => $imageUrl,
                    ],
                ],
            ],
        ];

        $postdata = json_encode($data);

        $header = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/swipeloan-3c146/messages:send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function getAccessToken()
    {
        $jsonKeyFilePath = storage_path('app/public/swipeloan-3c146-bf83f031f8cd.json');

        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            $jsonKeyFilePath
        );

        $accessToken = $credentials->fetchAuthToken();

        if (isset($accessToken['access_token'])) {
            return $accessToken['access_token'];
        } else {
            throw new \Exception('Failed to obtain access token: ' . json_encode($accessToken));
        }
    }

    public function sendSMS($mobile, $otp)
    {
        if (substr($mobile, 0, 2) === '91' && strlen($mobile) === 10) {
            $mobile = '91' . substr($mobile, 2);
        } elseif (substr($mobile, 0, 2) !== '91') {
            $mobile = '91' . $mobile;
        }

        $baseUrl = "https://push3.aclgateway.com/servlet/com.aclwireless.pushconnectivity.listeners.TextListener";
        $params = [
            'appid'       => 'swipsmbalt',
            'userId'      => 'swipsmbalt',
            'pass'        => 'kgil_08alt',
            'contenttype' => "1",
            'from'        => 'SWIPEL',
            'to'          => $mobile,
            'text'        => "Welcome to Swipeloan app! Your OTP is $otp. Powered by KGIL FINTECH SOLUTIONS PRIVATE LIMITED.",
            'alert'       => 1,
            'selfid'      => "true"
        ];

        $url = $baseUrl . '?' . http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return "Error: $error";
        }

        curl_close($ch);
        return $response;
    }
}
