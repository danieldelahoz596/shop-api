<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Men', 
                'image_url' => '/storage/landing_category/cat_1.png',
                'slug' => 'Men',
                'status' => 1
            ],
            [
                'name' => 'Women',
                'image_url' => '/storage/landing_category/cat_1.png',
                'slug' => 'Women',
                'status' => 1
            ],
            [
                'name' => 'Kids',
                'image_url' => '/storage/landing_category/cat_1.png',
                'slug' => 'Kids',
                'status' => 1
            ],
            [
                'name' => 'Tops',
                'image_url' => '/storage/landing_category/cat_1.png',
                'slug' => 'Tops',
                'status' => 1
            ],
            [
                'name' => 'Bottoms',
                'image_url' => '/storage/landing_category/cat_2.png',
                'slug' => 'Bottoms',
                'status' => 1
            ],
            [
                'name' => 'Shoes',
                'image_url' => '/storage/landing_category/cat_3.png',
                'slug' => 'Shoes',
                'status' => 1
            ],
            [
                'name' => 'Shorts',
                'image_url' => '/storage/landing_category/cat_4.png',
                'slug' => 'Shorts',
                'status' => 1
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
