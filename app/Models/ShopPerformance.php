<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPerformance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sales_total',
        'orders_count',
        'engagements_likes',
        'engagements_shares',
        'visitors',
        'conversion_rate',
        'return_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

