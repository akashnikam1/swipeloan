<?php

namespace App\Services;

use App\Models\ContactUs;

class ContactUsService
{
    protected $ContactUsModel;

    public function __construct()
    {
        $this->ContactUsModel = new ContactUs();
    }

    public function fetchRecord($data = [])
    {
        $contacts = [];
    
        $this->ContactUsModel->with('users')->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$contacts) {
            foreach ($chunk as $contact) {
                $contacts[] = $contact;
            }
        });
    
        return collect($contacts);
    }
}