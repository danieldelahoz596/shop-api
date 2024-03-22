<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'discount_symbol',
        'discount_value',
        'start_date',
        'end_date',
        'status'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
