<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KidsSubsubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryId = Category::where('slug', 'kids')->first();

        $subCategories = SubCategory::where('category_id', $categoryId->id)->get();

        $subSubcategories = [
            'infants' => [
                'Onesies and Bodysuits',
                'Sleepwear',
                'Tops',
                'Bottoms',
                'Mittens',
                'Hats',
                'Socks',
            ],
            'toddlers' => [
                'Tops',
                'Bottoms',
                'Dresses and Rompers',
                'Outerwear',
                'Sleepwear',
                'Swimwear',
            ],
            'girls' => [
                'Tops',
                'Pants',
                'Skirts',
                'Shorts',
                'Dresses and Rompers',
                'Activewear',
                'Outerwear',
                'Formalwear',
                'Sleepwear',
                'Accessories',
            ],
            'boys' => [
                'Shirts',
                'Jeans',
                'Shorts',
                'Activewear',
                'Outerwear',
                'Formalwear',
                'Sleepwear',
                'Accessories',
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
