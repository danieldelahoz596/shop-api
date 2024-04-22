<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $fillable = [
        'weight',
        'width',
        'height',
        'depth' ,
        'shipping_type',
    ];

    /**
     * Get the user that owns the Shipping
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
