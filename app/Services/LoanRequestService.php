<?php

namespace App\Services;

use App\Models\LoanRequest;

class LoanRequestService
{
    protected $LoanRequestModel;

    public function __construct()
    {
        $this->LoanRequestModel = new LoanRequest();
    }

    public function fetchRecord($data = [])
    {
        $loanRequests = [];
    
        $this->LoanRequestModel->with('loan_users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$loanRequests) {
            foreach ($chunk as $loanRequest) {
                $loanRequests[] = $loanRequest;
            }
        });
    
        return collect($loanRequests);
    }

    public function fetch($loan_id = 0)
    {
        return $this->LoanRequestModel->where('id', $loan_id)->with('loan_users', 'nbfc')->with('users')->first();
    }    
}