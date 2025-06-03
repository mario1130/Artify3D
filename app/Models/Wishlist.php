<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'wishlist_group_id'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con el grupo de listas de deseos
    public function wishlistGroup()
    {
        return $this->belongsTo(WishlistGroup::class);
    }
}
