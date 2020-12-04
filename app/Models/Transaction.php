<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Transaction extends Model
{
    protected $fillable = [
        'users_id', 'insurance_price', 'shipping_price', 'total_price', 'code', 'transaction_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
