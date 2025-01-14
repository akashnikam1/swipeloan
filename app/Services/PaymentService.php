<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    protected $PaymentModel;

    public function __construct()
    {
        $this->PaymentModel = new Payment();
    }

    public function fetchRecord($data = [])
    {
        $payments = [];
    
        $this->PaymentModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$payments) {
            foreach ($chunk as $payment) {
                $payments[] = $payment;
            }
        });
    
        return collect($payments);
    }
}