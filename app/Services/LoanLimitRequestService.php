<?php

namespace App\Services;

use App\Models\LoanLimitRequest;

class LoanLimitRequestService
{
    protected $LoanLimitRequestModel;

    public function __construct()
    {
        $this->LoanLimitRequestModel = new LoanLimitRequest();
    }

    public function fetchRecord($data = [])
    {
        $loanRequests = [];
    
        $this->LoanLimitRequestModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$loanRequests) {
            foreach ($chunk as $loanRequest) {
                $loanRequests[] = $loanRequest;
            }
        });
    
        return collect($loanRequests);
    }
}
