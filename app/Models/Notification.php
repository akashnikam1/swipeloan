<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'notification_filter_conditions_id',
        'value'
    ];

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function notificationConditions()
    {
        return $this->belongsTo(NotificationConditionFilter::class, 'notification_filter_conditions_id');
    }
}
