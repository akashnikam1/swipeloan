<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserNotificationService;
use DataTables;

class UserNotificationController extends Controller
{
    protected $UserNotificationService;

    public function __construct()
    {
        $this->UserNotificationService = new UserNotificationService();
    }

    public function getAllUserNotifications(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->UserNotificationService->fetchRecord($data);
            
            return DataTables::of($record)->make(true);
        }
        return view('user_notifications.all');
    }
}
