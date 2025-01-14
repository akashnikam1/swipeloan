<?php

namespace App\Services;

use App\Models\UserNotification;

class UserNotificationService
{
    protected $UserNotificationModel;

    public function __construct()
    {
        $this->UserNotificationModel = new UserNotification();
    }

    public function fetchRecord($data = [])
    {
        $records = [];
        $this->UserNotificationModel
            ->orderBy('id', 'DESC')
            ->with(['users:id,first_name,last_name'])
            ->chunk(1000, function ($chunk) use (&$records) {
                foreach ($chunk as $record) {
                    $records[] = $record;
                }
            });
    
        return collect($records);
    }
}
