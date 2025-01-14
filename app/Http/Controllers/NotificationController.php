<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoanRequest;
use App\Models\NotificationConditionFilter;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Jobs\SendPushNotificationJob;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    protected $NotificationService;

    public function __construct()
    {
        $this->NotificationService = new NotificationService();
    }

    public function getAllNotifications(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->NotificationService->fetchRecord($data);

            return DataTables::of($record)
                ->addColumn('action', function ($rec) {
                    $actions = '<ul class="nk-tb-actions gx-1 my-n1">
                    <li class="me-n1">
                        <div class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="' . url('notifications/edit') . '/' . $rec->id . '"><em class="icon ni ni-edit"></em><span>Edit Notification</span></a></li>
                        </ul>
                        </div>
                    </div>
                    </li>
                </ul>';
                    return $actions;    
                })->rawColumns(['action'])->make(true);
        }
        return view('notifications.all');
    }

    public function getAllAutoNotifications(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = $this->NotificationService->fetchAutoNotificationRecord($data);

            return DataTables::of($record)->make(true);
        }
        return view('auto_notifications.all');
    }   

    public function getAddNotification()
    {
        $notification_conditions = NotificationConditionFilter::where('is_active', 1)->get();
        return view('notifications.add', compact('notification_conditions'));
    }

    public function addNotification(Request $request)
    {
        $rules = [
            'image' => 'required|image|max:100|dimensions:width=400,height=300',
            'title' => 'required',
            'description' => 'required',
            'notification_filter_conditions_id' => 'required',
        ];

        $messages = [
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image size must not exceed 100KB.',
            'image.dimensions' => 'The image dimensions must be exactly 400x300 pixels.',
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'notification_filter_conditions_id.required' => 'The notification filter condition field is required.',
        ];

        $conditionId = $request->notification_filter_conditions_id;

        if ($conditionId == 2) {
            $rules['regDayValue'] = 'required';
            $messages['regDayValue.required'] = 'The registration days field is required.';
        } elseif ($conditionId == 3) {
            $rules['closedDayValue'] = 'required';
            $messages['closedDayValue.required'] = 'The closed days field is required.';
        } elseif ($conditionId == 4) {
            $rules['user_id'] = 'required';
            $messages['user_id.required'] = 'The name and phone number field is required.';
        }

        $request->validate($rules, $messages);

        switch ($conditionId) {
            case 1:
                $value = 0;
                break;
            case 2:
                $value = $request->regDayValue;
                break;
            case 3:
                $value = $request->closedDayValue;
                break;
            case 4:
                $value = $request->user_id;
                break;
            default:
                $value = 0;
                break;
        }

        $notificationImagePath = NULL;
        if (isset($request->image)) {
            $notificationImage = $request->file('image');
            $number = rand(1111111, 999999);
            $notificationImagePath = "Notifications/Notification{$number}.".$notificationImage->getClientOriginalExtension();
            Storage::putFileAs('public', $notificationImage, $notificationImagePath);
        }
        $data = $request->all();
        $data['value'] = $value;
        $data['image'] = $notificationImagePath;
        $response = $this->NotificationService->addNotification($data);
 
        if ($response) {
            return redirect('notifications/all')->with('success', 'Notification added successfully.');
        }
        return redirect('notifications/all')->with('error', 'Something went wrong');
    }

    public function getEditNotification($id)
    {
        $data = $this->NotificationService->fetch($id);
        $notification_conditions = NotificationConditionFilter::where('is_active', 1)->get();

        if ($data) {
            return view('notifications.edit', compact('data', 'notification_conditions'));
        }
        return redirect('notifications/all')->with('error', 'Something went wrong');
    }

    public function updateNotification(Request $request, $id)
    {
        $rules = [
            'image' => 'nullable|image|max:100|dimensions:width=400,height=300',
            'title' => 'required',
            'description' => 'required',
            'notification_filter_conditions_id' => 'required',
        ];

        $messages = [
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image size must not exceed 100KB.',
            'image.dimensions' => 'The image dimensions must be exactly 400x300 pixels.',
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'notification_filter_conditions_id.required' => 'The notification filter condition field is required.',
        ];

        $conditionId = $request->notification_filter_conditions_id;

        if ($conditionId == 2) {
            $rules['regDayValue'] = 'required';
            $messages['regDayValue.required'] = 'The registration days field is required.';
        } elseif ($conditionId == 3) {
            $rules['closedDayValue'] = 'required';
            $messages['closedDayValue.required'] = 'The closed days field is required.';
        } elseif ($conditionId == 4) {
            $rules['user_id'] = 'required';
            $messages['user_id.required'] = 'The name and phone number field is required.';
        }

        $request->validate($rules, $messages);
        
        switch ($conditionId) {
            case 1:
                $value = 0;
                break;
            case 2:
                $value = $request->regDayValue;
                break;
            case 3:
                $value = $request->closedDayValue;
                break;
            case 4:
                $value = $request->user_id;
                break;
            default:
                $value = 0;
                break;
        }

        $notificationImagePath = NULL;
        if ($request->hasFile('image')) {
            $notification = $this->NotificationService->fetch($request->id);
            if ($notification && $notification->image) {
                Storage::delete('public/' . $notification->image);
            }

            $notificationImage = $request->file('image');
            $number = rand(1111111, 999999);
            $notificationImagePath = "Notifications/Notification{$number}.".$notificationImage->getClientOriginalExtension();
            Storage::putFileAs('public', $notificationImage, $notificationImagePath);
        }

        $data = $request->all();
        $data['value'] = $value;
        $data['id'] = $request->id;
        if ($notificationImagePath) {
            $data['image'] = $notificationImagePath;
        }
        $response = $this->NotificationService->editNotification($data);
        if ($response) {
            return redirect('notifications/all')->with('success', 'Notification updated successfully.');
        }
        return redirect('notifications/all')->with('error', 'Something went wrong');
    }

    public function fetchUsers(Request $request)
    {
        $searchValue = $request->input('search_value');
        $userId = $request->input('user_id');

        if($userId) {
            $users = User::where('id', $userId)->get(['id', 'first_name', 'last_name', 'phone_number']);
        } else {
            $users = User::where('phone_number', 'like', "%$searchValue%")
                        ->orWhere('first_name', 'like', "%$searchValue%")
                        ->orWhere('last_name', 'like', "%$searchValue%")
                        ->where('is_active', 1)
                        ->where('role_id', 2)
                        ->get(['id', 'first_name', 'last_name', 'phone_number']);
        }

        return response()->json($users);
    }

    public function fetchUsersCount(Request $request)
    {
        $value = $request->input('value');
        $status = $request->input('status');

        if($status == 1){
            $usersCount = User::where('is_active', 1)
                    ->where('role_id', 2)
                    ->count();
        } elseif($status == 2){
            $startDate = Carbon::now()->subDays($value)->startOfDay();
            $endDate = Carbon::now()->endOfDay();

            $usersCount = User::whereBetween('created_at', [$startDate, $endDate])
                        ->where('is_active', 1)
                        ->where('role_id', 2)
                        ->count();
        } elseif($status == 3) {
            $startDate = Carbon::now()->subDays($value)->startOfDay();
            $endDate = Carbon::now()->endOfDay();

            $loanRequests = LoanRequest::whereBetween('closed_on', [$startDate, $endDate])->get();
            $userIds = $loanRequests->pluck('user_id')->unique()->toArray();
            $usersCount = User::whereIn('id', $userIds)
                        ->where('is_active', 1)
                        ->count();
        } elseif($status == 4) {
            $usersCount = User::where('id', $value)
                    ->where('is_active', 1)
                    ->count();
        } else {
            $usersCount = 0;
        }

        return response()->json(['users_count' => $usersCount]);
    }

    public function pushNotification(Request $request, $notificationId)
    {        
        $notificationData = $this->NotificationService->fetch($notificationId);

        if($notificationData)
        {
            if($notificationData['notification_filter_conditions_id'] == 1)
            {
                $users = User::where('is_active', 1)
                        ->where('is_notification', 1)
                        ->where('role_id', 2)
                        ->get();
            } 
            else if($notificationData['notification_filter_conditions_id']  == 2) 
            {
                $value = $notificationData['value'];
                $startDate = Carbon::now()->subDays($value)->startOfDay();
                $endDate = Carbon::now()->endOfDay();

                $users = User::whereBetween('created_at', [$startDate, $endDate])
                        ->where('is_active', 1)
                        ->where('is_notification', 1)
                        ->where('role_id', 2)
                        ->get();
            }
            else if($notificationData['notification_filter_conditions_id']  == 3) 
            {
                $value = $notificationData['value'];
                $startDate = Carbon::now()->subDays($value)->startOfDay();
                $endDate = Carbon::now()->endOfDay();

                $loanRequests = LoanRequest::whereBetween('closed_on', [$startDate, $endDate])->get();
                $userIds = $loanRequests->pluck('user_id')->unique()->toArray();
                $users = User::whereIn('id', $userIds)
                        ->where('is_notification', 1)
                        ->where('is_active', 1)
                        ->get();
            }
            else if($notificationData['notification_filter_conditions_id'] == 4) 
            {
                $value = $notificationData['value'];

                $users = User::where('id', $value)
                        ->where('is_notification', 1)
                        ->where('is_active', 1)
                        ->get();
            }
        }

        foreach($users as $user) 
        {
            $data = [
                'notification_id' => $notificationData['id'],
                'title' => $notificationData['title'],
                'description' => $notificationData['description'],
                'image' => $notificationData['image'],
                'user_id' => $user->id,
                'firebase_token' => $user->firebase_token
            ];

            SendPushNotificationJob::dispatch($data);
        }

        return redirect('notifications/all')->with('success', 'Notification sent successfully.');
    }
}