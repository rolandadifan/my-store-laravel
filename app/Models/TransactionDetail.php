<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Transaction;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transactions_id', 'products_id', 'price', 'resi', 'code', 'shipping_status'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'transactions_id');
    }
}
