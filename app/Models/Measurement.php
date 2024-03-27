<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'measurement_symbol',
        'chest',
        'shoulders',
        'sleeve_length',
        'length',
        'hem'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
