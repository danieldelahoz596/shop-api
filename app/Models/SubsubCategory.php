<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_subcategories';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'status'
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
