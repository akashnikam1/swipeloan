<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'tenure',
        'cibil_score',
        'is_active'
    ];
}
