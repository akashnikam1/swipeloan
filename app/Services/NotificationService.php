<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    protected $NotificationModel;

    public function __construct()
    {
        $this->NotificationModel = new Notification();
    }

    public function addNotification($data = [])
    {
        return $this->NotificationModel->create([
            'image' => $data['image'],
            'title' => $data['title'],
            'description' => $data['description'],
            'notification_filter_conditions_id' => $data['notification_filter_conditions_id'],
            'value' => $data['value'] 
        ]);
    }

    public function fetch(int $notification_id = 0)
    {
        return $this->NotificationModel->find($notification_id);
    }

    public function fetchRecord($data = [])
    {
        $idsToCheck = [1, 2];
        $notifications = [];
    
        $this->NotificationModel->whereNotIn('id', $idsToCheck)->orderBy('id', 'DESC')->chunk(1000, function ($chunk) use (&$notifications) {
            foreach ($chunk as $notification) {
                $notifications[] = $notification;
            }
        });
    
        return collect($notifications);
    }

    public function fetchAutoNotificationRecord($data = [])
    {
        $idsToCheck = [1, 2];
        $records = $this->NotificationModel->whereIn('id', $idsToCheck)->orderBy('id', 'DESC')->get();

        if ($records->isEmpty()) {
            return collect();
        }
        
        return $records;
    }

    public function editNotification($data = [])
    {
        $id = $data['id'];
        unset($data['id']);

        $banner = $this->NotificationModel->find($id);

        if(isset($data['image']))
        {
            $fieldsToUpdate = [
                'image' => $data['image'],
                'title' => $data['title'],
                'description' => $data['description'],
                'notification_filter_conditions_id' => $data['notification_filter_conditions_id'],
                'value' => $data['value'] 
            ];

            if ($banner) {
                $response = $this->NotificationModel->where('id', $id)->update($fieldsToUpdate);
                if ($response) {
                    return [
                        'status' => 'success',
                        'message' => 'Notification details updated successfully.'
                    ];
                }
            }
        }
        $fieldsToUpdate = [
            'title' => $data['title'],
            'description' => $data['description'],
            'notification_filter_conditions_id' => $data['notification_filter_conditions_id'],
            'value' => $data['value'] 
        ];

        if ($banner) {
            $response = $this->NotificationModel->where('id', $id)->update($fieldsToUpdate);
            if ($response) {
                return [
                    'status' => 'success',
                    'message' => 'Notification details updated successfully.'
                ];
            }
        }
    }
}
