<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'user_id',
        'product_code',
        'product_name',
        'product_description',
        'product_brand',
        'slug',
        'price',
        'quantity',
        'keyword',
        'status',
        'image',
    ];

    protected $casts = [
        'keyword' => 'array',
        'size' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productSold()
    {
        return $this->hasMany(ProductSold::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

}
