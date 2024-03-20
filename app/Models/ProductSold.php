<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSold extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'item_price',
        'item_quantity',
        'discount',
        'total',
        'mode_of_payment'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
