<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NbfcTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nbfc_id',
        'amount',
        'transaction_type'
    ];

    public function nbfc()
    {
        return $this->belongsTo(Nbfc::class, 'nbfc_id');
    }
}
