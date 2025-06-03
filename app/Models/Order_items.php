<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $fillable = [
        'order_id',
        'product_name',
        'product_price',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
