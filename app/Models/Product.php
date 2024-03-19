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
        'keyword' => 'array'
    ];
}
