<?php

namespace App\Jobs;

use App\Http\Controllers\Controller;
use App\Models\UserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $notificationData;

    public function __construct($notificationData)
    {
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $controller = new Controller();
        $controller->sendPushNotification($this->notificationData);

        // Save Data in Table
        
        $userNotification = new UserNotification();
        $userNotification->notification_id = $this->notificationData['notification_id'];
        $userNotification->user_id = $this->notificationData['user_id'];
        $userNotification->title = $this->notificationData['title'];
        $userNotification->description = $this->notificationData['description'];
        $userNotification->image = $this->notificationData['image'];
        $userNotification->save();
    }
}
