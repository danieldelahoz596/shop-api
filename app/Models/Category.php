<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'status'
    ];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
