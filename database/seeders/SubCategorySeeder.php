<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $womenSubCats = [
            'Tops',
            'Bottoms',
            'Dresses',
            'Rompers and Bodysuits',
            'Outerwear',
            'Activewear',
            'Swimwear',
            'Undergarments',
            'Sleepwear',
            'Accessories'
        ];

        $menSubCats = [
            'Tops',
            'Bottoms',
            'Suits and Formal Wear',
            'Activewear',
            'Outerwear',
            'Casual Wear',
            'Swimwear',
            'Underwear',
            'Sleepwear',
            'Accessories'
        ];

        $kidsSubCats = [
            'Infants',
            'Toddlers',
            'Girls',
            'Boys'
        ];

        $menCategoryId = Category::where('slug', 'men')->first()->id;
        $womenCategoryId = Category::where('slug', 'women')->first()->id;
        $kidsCategoryId = Category::where('slug', 'kids')->first()->id;

        foreach ($womenSubCats as $womenSubCategory) {
            $slug = strtolower(str_replace(' ', '-', $womenSubCategory));
            SubCategory::create([
                'category_id' => $womenCategoryId,
                'name' => $womenSubCategory,
                'slug' => $slug,
                'status' => true
            ]);
        }

        foreach ($menSubCats as $menSubCategory) {
            $slug = strtolower(str_replace(' ', '-', $menSubCategory));
            SubCategory::create([
                'category_id' => $menCategoryId,
                'name' => $menSubCategory,
                'slug' => $slug,
                'status' => true
            ]);
        }

        foreach ($kidsSubCats as $subCategory) {
            $slug = strtolower(str_replace(' ', '-', $subCategory));
            SubCategory::create([
                'category_id' => $kidsCategoryId,
                'name' => $subCategory,
                'slug' => $slug,
                'status' => true
            ]);
        }
    }
}
