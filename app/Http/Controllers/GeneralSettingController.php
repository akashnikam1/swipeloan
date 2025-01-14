<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeneralSettingService;

class GeneralSettingController extends Controller
{
    protected $GeneralSettingService;

    public function __construct()
    {
        $this->GeneralSettingService = new GeneralSettingService();
    }

    public function getEditGeneralSetting($id)
    {
        $data = $this->GeneralSettingService->fetch($id);
        if ($data) {
            return view('general_settings.edit', compact('data'));
        }
        return redirect('general_settings/edit/1')->with('error', 'Something went wrong');
    }

    public function updateGeneralSetting(Request $request, $id)
    {
        $request->validate([
            'referral_amount' => 'required',
            'home_screen_video_link' => 'required | url',
            'payment_mode' => 'required',
            'pincode_note' => 'required',
            'version' => 'required',
            'is_force_update' => 'required',
            'credit_report_amount' => 'required'
        ], [
            'referral_amount.required' => 'The referral amount field is required.',
            'home_screen_video_link.required' => 'The home screen video link field is required.',
            'payment_mode.required' => 'The payment mode field is required.',
            'pincode_note.required' => 'The pincode note field is required.',
            'version.required' => 'The version field is required.',
            'is_force_update.required' => 'The force update field is required.',
            'credit_report_amount.required' => 'The credit report amount field is required.',
        ]);
        
        $data = $request->all();
        $data['id'] = $request->id;
        $response = $this->GeneralSettingService->editGeneralSetting($data);
        if ($response) {
            return redirect('general_settings/edit/1')->with('success', 'General setting updated successfully.');
        }
        return redirect('general_settings/edit/1')->with('error', 'Something went wrong');
    }
}
