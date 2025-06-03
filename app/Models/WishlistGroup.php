<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistGroup extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    // Relación con las listas de deseos
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
