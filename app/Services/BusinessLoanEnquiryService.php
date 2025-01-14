<?php

namespace App\Services;

use App\Models\BusinessLoanRequirement;

class BusinessLoanEnquiryService
{
    protected $BusinessLoanRequirementModel;

    public function __construct()
    {
        $this->BusinessLoanRequirementModel = new BusinessLoanRequirement();
    }

    public function fetchRecord($data = [])
    {
        $requirements = [];
    
        $this->BusinessLoanRequirementModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$requirements) {
            foreach ($chunk as $requirement) {
                $requirements[] = $requirement;
            }
        });
    
        return collect($requirements);
    }
}
