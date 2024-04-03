<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewHistory extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'review_id',
        'user_id',
        'comment',
        'rating'
    ];

    public function reviews()
    {
        return $this->belongsTo(Review::class);
    }
}
