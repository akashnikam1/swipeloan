<?php

namespace App\Services;

use App\Models\GeneralSetting;

class GeneralSettingService
{
    protected $GeneralSettingModel;

    public function __construct()
    {
        $this->GeneralSettingModel = new GeneralSetting();
    }

    public function fetch(int $general_setting_id = 0)
    {
        return $this->GeneralSettingModel->find($general_setting_id);
    }

    public function editGeneralSetting($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $generalSetting = $this->GeneralSettingModel->find($id);

        $fieldsToUpdate = [
            'referral_amount' => $data['referral_amount'],
            'home_screen_video_link' => $data['home_screen_video_link'],
            'payment_mode' => $data['payment_mode'],
            'pincode_note' => $data['pincode_note'],
            'version' => $data['version'],
            'is_force_update' => $data['is_force_update'],
            'credit_report_amount' => $data['credit_report_amount'],
        ];
        
        if ($generalSetting) {
            $response = $this->GeneralSettingModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'General Setting details updated successfully.'
                ];
            }
        }
    }
}
