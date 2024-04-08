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
        'reviewable_id',
        'reviewable_type'
    ];

    public function reviewable()
    {
        return $this->morphTo('reviewable', 'reviewable_type', 'reviewable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
