<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'email',
        'message'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
