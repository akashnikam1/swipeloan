<?php

namespace App\Services;

use App\Models\Partner;

class PartnerService
{
    protected $PartnerModel;

    public function __construct()
    {
        $this->PartnerModel = new Partner();
    }

    public function addPartner($data = [])
    {
        return $this->PartnerModel->create([
            'partner_image' => $data['partner_image'],
            'partner_name' => $data['partner_name']
        ]);
    }

    public function fetch(int $partner_id = 0)
    {
        return $this->PartnerModel->find($partner_id);
    }

    public function fetchRecord($data = [])
    {
        return $this->PartnerModel->orderBy('id', 'DESC')->get();
    }

    public function editPartner($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $partner = $this->PartnerModel->find($id);

        if(isset($data['partner_image']))
        {
            $fieldsToUpdate = [
                'partner_image' => $data['partner_image'],
                'partner_name' => $data['partner_name']
            ];

            if ($partner) {
                $response = $this->PartnerModel->where('id', $id)->update($fieldsToUpdate);
                if ($response) {
                    return [
                        'status' => 'success',
                        'message' => 'Partner details updated successfully.'
                    ];
                }
            }
        }
        
        $fieldsToUpdate = [
            'partner_name' => $data['partner_name']
        ];

        if ($partner) {
            $response = $this->PartnerModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Partner details updated successfully.'
                ];
            }
        }
    }
}
