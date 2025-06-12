<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Order_items;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method',
        'card_number',
        'card_expiry',
        'card_cvc',
        'card_name',
        'status',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(Order_items::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
