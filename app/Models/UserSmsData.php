<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSmsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'message_body',
        'date',
        'is_read',
        'type'
    ];
}
