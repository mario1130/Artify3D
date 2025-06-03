<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = [
        'order_item_id',
        'user_id',
        'reason',
        'status',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
