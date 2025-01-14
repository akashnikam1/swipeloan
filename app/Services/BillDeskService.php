<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class BillDeskService
{
    protected $clientId;
    protected $secretKey;

    public function __construct()
    {
        $this->clientId = 'uatkgilf';
        $this->secretKey = '3dUOrLsz5Mq8DGaBvSa5R5OLMlGnX2qh';
    }

    public function encodeAndSign($payload)
    {
        $header = [
            'alg' => 'HS256',
            'clientid' => $this->clientId,
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256', null, $header);
    }

    public function decode($data)
    {
        return JWT::decode($data, new Key($this->secretKey, 'HS256'));
    }
}
