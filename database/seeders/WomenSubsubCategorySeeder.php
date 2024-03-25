<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WomenSubsubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryId = Category::where('slug', 'women')->first();

        $subCategories = SubCategory::where('category_id', $categoryId->id)->get();

        $subSubcategories = [
            'tops' => [
                'Blouses',
                'T-shirts',
                'Cropped Tops',
                'Tank Tops and Camisoles',
                'Tube Tops',
                'Polo Shirts',
                'Sweaters',
                'Others',
            ],
            'bottoms' => [
                'Jeans',
                'Pants',
                'Skirts',
                'Shorts',
                'Leggings',
            ],
            'dresses' => [
                'Casual Dresses',
                'Formal Dresses',
                'Maxi Dresses',
                'Mini Dresses',
            ],
            'outerwear' => [
                'Coats',
                'Jackets',
                'Blazers',
                'Cardigans',
            ],
            'activewear' => [
                'Sports Bras',
                'Athletic Leggings',
                'Performance Tops',
                'Athletic Jackets',
            ],
            'swimwear' => [
                'Bikinis',
                'One-Piece Swimsuits',
                'Cover-ups',
            ],
            'undergarments' => [
                'Bras',
                'Panties',
                'Lingerie Sets',
            ],
            'sleepwear' => [
                'Pajamas',
                'Nightgowns',
                'Sleep Shirts',
            ],
            'accessories' => [
                'Handbags',
                'Hats',
                'Scarves',
            ]
        ];

        foreach ($subCategories as $subCategory) {
            foreach ($subSubcategories as $key => $subSubcategory) {
                if ($key === $subCategory->slug) {
                    foreach ($subSubcategory as $data) {
                        $slug = strtolower(str_replace(' ', '-', $data));
                        SubsubCategory::create([
                            'category_id' => $subCategory->category_id,
                            'subcategory_id' => $subCategory->id,
                            'slug' => $slug,
                            'name' => $data,
                        ]);
                    }
                }
            }
        }
    }
}
