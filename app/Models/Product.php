<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'precio', 'category_id'];

    protected $casts = [
        'secondary_images' => 'array',
    ];

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
}
