<?php

namespace App\Services;

use App\Models\CreditReportTransaction;

class CreditReportTransactionService
{
    protected $CreditReportTransactionModel;

    public function __construct()
    {
        $this->CreditReportTransactionModel = new CreditReportTransaction();
    }

    public function fetchRecord($data = [])
    {
        $transactions = [];

        $this->CreditReportTransactionModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$transactions) {
            foreach ($chunk as $transaction) {
                $transactions[] = $transaction;
            }
        });

        return collect($transactions);
    }
}
