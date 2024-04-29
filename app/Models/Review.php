<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'comment',
        'rating',
        'image'
    ];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'reviewables');
    }
    public function shops()
    {
        return $this->morphedByMany(SellerShop::class, 'reviewables');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
