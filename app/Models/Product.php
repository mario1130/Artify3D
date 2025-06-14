<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_items;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'precio', 'category_id', 'user_id','download_url'];

    protected $casts = [
        'secondary_images' => 'array',
    ];

    public function hasBeenPurchasedBy($userId)
    {
        return Order_items::where('product_id', $this->id)
            ->whereHas('order', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function mainPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->where('is_main', true);
    }

    public function secondaryPhotos()
    {
        return $this->hasMany(ProductPhoto::class)->where('is_main', false);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('stars');
    }

    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }
    
}
