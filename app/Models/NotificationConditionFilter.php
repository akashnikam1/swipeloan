<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationConditionFilter extends Model
{
    use HasFactory;

    protected $fillable = [
        'filter_condition',
        'description'
    ];
}
