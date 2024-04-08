<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubsubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenSubsubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryId = Category::where('slug', 'men')->first();

        $subCategories = SubCategory::where('category_id', $categoryId->id)->get();

        $subSubcategories = [
            'tops' => [
                'T-shirts',
                'Polos',
                'Casual Shirts',
                'Dress Shirts',
                'Sweaters',
            ],
            'bottoms' => [
                'Jeans',
                'Chinos',
                'Dress Pants',
                'Shorts',
            ],
            'suits-and-formal-wear' => [
                'Suits',
                'Blazers',
                'Dress Shirts',
                'Ties',
            ],
            'activewear' => [
                'Athletic T-shirts',
                'Sports Jerseys',
                'Athletic Shorts',
                'Track Pants',
            ],
            'outerwear' => [
                'Jackets',
                'Coats',
                'Hoodies',
                'Vests',
            ],
            'casual-wear' => [
                'Hoodies',
                'Casual Jackets',
                'Casual Shirts',
            ],
            'swimwear' => [
                'Swim Trunks',
                'Board Shorts',
            ],
            'underwear' => [
                'Boxers',
                'Briefs',
                'Boxer Briefs',
            ],
            'sleepwear' => [
                'Pajamas',
                'Lounge Pants',
            ],
            'accessories' => [
                'Ties',
                'Belts',
                'Hats',
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
