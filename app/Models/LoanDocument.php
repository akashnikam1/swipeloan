<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'document_name',
        'document_url',
        'date'
    ];

    public function loans()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_id');
    }
}
