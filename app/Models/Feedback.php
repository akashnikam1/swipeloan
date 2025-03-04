<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_number',
        'rating',
        'description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
