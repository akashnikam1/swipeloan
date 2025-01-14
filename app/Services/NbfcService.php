<?php

namespace App\Services;

use App\Models\Nbfc;
use App\Models\NbfcTransaction;

class NbfcService
{
    protected $NbfcModel;
    protected $NbfcTransactionModel;

    public function __construct()
    {
        $this->NbfcModel = new Nbfc();
        $this->NbfcTransactionModel = new NbfcTransaction();
    }

    public function addNbfc($data = [])
    {
        $nbfc = $this->NbfcModel->create([
            'nbfc_name' => $data['nbfc_name'],
            'payment_limit' => $data['payment_limit'],
            'razorpay_key' => $data['razorpay_key'],
            'razorpay_secret' => $data['razorpay_secret'],
            'razorpayX_key' => $data['razorpayX_key'],
        ]);
    
        $this->NbfcTransactionModel->create([
            'nbfc_id' => $nbfc->id,           
            'amount' => $data['payment_limit'], 
            'transaction_type' => 'ADD',   
        ]);
    
        return $nbfc;
    }

    public function fetch(int $nbfc_id = 0)
    {
        return $this->NbfcModel->find($nbfc_id);
    }

    public function fetchRecord($data = [])
    {
        return $this->NbfcModel->orderBy('id', 'DESC')->get();
    }

    public function editNbfc($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $nbfc = $this->NbfcModel->find($id);

        $fieldsToUpdate = [
            'nbfc_name' => $data['nbfc_name'],
            'razorpay_key' => $data['razorpay_key'],
            'razorpay_secret' => $data['razorpay_secret'],
            'razorpayX_key' => $data['razorpayX_key'],
        ];

        if ($nbfc) {
            $response = $this->NbfcModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'NBFC details updated successfully.',
                ];
            }
        }
    }
}
