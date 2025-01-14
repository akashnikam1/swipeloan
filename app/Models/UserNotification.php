<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    
    protected $fillable = [
        'notification_id',
        'user_id',
        'title',
        'image',
        'description',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
