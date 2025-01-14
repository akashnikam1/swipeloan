<?php

namespace App\Services;

use App\Models\LoanStage;

class LoanStageService
{
    protected $LoanStageModel;

    public function __construct()
    {
        $this->LoanStageModel = new LoanStage();
    }

    public function fetchRecord($data = [])
    {
        return $this->LoanStageModel->get();
    }
}