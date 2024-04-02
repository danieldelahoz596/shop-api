<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
        'slug',
        'shop_tag',
        'shop_image',
        'view_count',
        'user_id',
        'rating',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
