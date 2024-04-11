<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'seller_id',
        'buyer_id',
        'address_id',
        'transaction_id',
        'item_price',
        'item_quantity',
        'voucher_code',
        'voucher_amount',
        'shipping_fee',
        'total',
        'status',
        'payment_status',
        'mode_of_payment'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
